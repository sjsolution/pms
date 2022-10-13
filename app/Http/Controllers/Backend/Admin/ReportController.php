<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Building;
use App\Models\Checkout;
use App\Models\PropertyRental;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class ReportController extends Controller
{
    public function index()
    {
        if (Auth::user()->hasRole('admin')) {
            $building = Building::all();
        } else {
            $user = User::where('id', user()->id)->first();
            $building = Building::where('id', $user->property_id)->first();
        }
        return view('backend.admin.pages.report.period_wise', compact('building'));
    }

    public function searchperiod(Request $request)
    {
        $building_id = $request->building_id;
        $date = explode('-', $request->datefilter);
        $fromDate = $date[0];
        $toDate = $date[1];
        $start = Carbon::parse($fromDate)->toDateString();
        $end = Carbon::parse($toDate)->toDateString();
        $property = PropertyRental::with('room','charges')->where(['building_id' => $building_id, 'property_rental' => 1])
            ->whereBetween('created_at', [$start, $end])->get();
        $charges = Checkout::where('building_id', $building_id)->first();
        $daily_total = $property->sum('total_amount');
        $checkout = Checkout::where('building_id', $building_id)->get();
        $additional = $checkout->sum('additional_charges');
        $total = $additional + $daily_total;

        return response()->json(['property' => $property, 'total' => $total, 'mesg' => 'Fetched Successfully']);
    }

    public function propertystatus()
    {
        $building = Building::all();
        return view('backend.admin.pages.report.propertystatus', compact('building'));
    }

    public function getpropertystatus(Request $request)
    {
        $building_id = $request->building_id;
        $room = Room::where('building_id', $building_id)->orderBy('id', 'desc')->get();
        return response()->json(['room' => $room, 'mesg' => 'fetched successfully']);
    }

    public function propertywise()
    {
        $building = Building::all();
        return view('backend.admin.pages.report.propertywise', compact('building'));
    }

    public function getpropertywise(Request $request)
    {
        $building_id = $request->building_id;
        $property = PropertyRental::with('building', 'flattype', 'room')->where(['building_id' => $building_id, 'property_rental' => 0])->orderBy('id', 'desc')->get();
        return response()->json(['property' => $property, 'mesg' => 'fetched successfully']);
    }

    public function receiveable_status()
    {
        $building = Building::all();
        return view('backend.admin.pages.report.receiveable_status', compact('building'));
    }

    public function getreceiveable_status(Request $request)
    {
        $building_id = $request->building_id;
        $property = PropertyRental::with('building', 'flattype', 'room')->where(['building_id' => $building_id])->orderBy('id', 'desc')->get();
        return response()->json(['property' => $property, 'mesg' => 'fetched successfully']);
    }

    public function paymentproperty()
    {
        $building = Building::all();
        return view('backend.admin.pages.report.payment_property', compact('building'));
    }
    public function getpaymentproperty(Request $request)
    {
        $building_id = $request->building_id;
        $property = PropertyRental::with('building', 'flattype', 'room')->where(['building_id' => $building_id, 'property_rental' => 0])->orderBy('id', 'desc')->get();
        return response()->json(['property' => $property, 'mesg' => 'fetched successfully']);
    }
}
