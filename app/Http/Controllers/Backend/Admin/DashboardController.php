<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Building;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::user()->hasRole('admin')) {
            $building = Building::all();
            $room = '';
            $vacantcount = '';
            $occupiedcount = '';
        } else {
            $user = User::where('id', user()->id)->first();
            $building = Building::where('id', $user->property_id)->first();
            $room = Room::with('flattype')->where('building_id', $user->property_id)->get();
            $vacantcount = Room::with('flattype')->where(['building_id' => $user->property_id, 'status' => '1'])->count();
            $occupiedcount = Room::with('flattype')->where(['building_id' => $user->property_id, 'status' => '0'])->count();
        }
        return view('backend.admin.pages.dashboard.index', compact('building', 'room', 'vacantcount', 'occupiedcount'));
    }

    public function getroom(Request $request)
    {
        $building_id = $request->building_id;
        $room = Room::with('flattype')->where('building_id', $building_id)->get();
        $vacantcount = Room::with('flattype')->where(['building_id' => $building_id, 'status' => '1'])->count();
        $occupiedcount = Room::with('flattype')->where(['building_id' => $building_id, 'status' => '0'])->count();

        return response()->json(['room' => $room, 'vacantcount' => $vacantcount, 'occupiedcount' => $occupiedcount]);
    }

    public function term()
    {
        return view('backend.admin.pages.dashboard.term');
    }
}
