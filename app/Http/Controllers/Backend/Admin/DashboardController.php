<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Building;
use App\Models\Room;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $building = Building::all();
        return view('backend.admin.pages.dashboard.index', compact('building'));
    }

    public function getroom(Request $request){
        $building_id = $request->building_id;
        $room = Room::with('flattype')->where('building_id',$building_id)->get();
        $vacantcount = Room::with('flattype')->where(['building_id'=>$building_id, 'status'=> '1'])->count();
        $occupiedcount = Room::with('flattype')->where(['building_id'=>$building_id, 'status'=> '0'])->count();

        return response()->json(['room'=>$room, 'vacantcount'=>$vacantcount, 'occupiedcount'=>$occupiedcount]);
    }

}
