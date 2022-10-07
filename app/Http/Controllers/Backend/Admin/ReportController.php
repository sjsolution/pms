<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Building;
use App\Models\PropertyRental;
use App\Models\Room;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index()
    {
        $building = Building::all();
        $property = '';
        $total = '';
        return view('backend.admin.pages.report.period_wise', compact('building', 'property', 'total'));
    }

    public function searchperiod(Request $request)
    {
        $building_id = $request->building_id;
        $date = explode('-', $request->datefilter);
        $fromDate = $date[0];
        $toDate = $date[1];
        $start = Carbon::parse($fromDate)->toDateString();
        $end = Carbon::parse($toDate)->toDateString();
        $property = PropertyRental::with('room')->where('building_id', $building_id)
            ->whereBetween('created_at', [$start, $end])->get();
        $monthly_total = $property->sum('monthly_rent');
        $daily_total = $property->sum('total_amount');
        $total = $monthly_total + $daily_total;

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
}
