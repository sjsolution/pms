<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $room = Room::all();
        return view('backend.admin.pages.dashboard.index', compact('room'));
    }
}
