<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\{FlatType, PropertyRegister, Room};
use Illuminate\Http\Request;
use App\Validations\AdminValidations;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $room = Room::with('building', 'flattype')->get();
        return view('backend.admin.pages.rooms.index', compact('room'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $property = PropertyRegister::all();
        $flattype = FlatType::all();
        return view('backend.admin.pages.rooms.form', compact('property', 'flattype'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $validator = AdminValidations::roomregister($request);
            if (!empty($validator)) {
                return redirect()->route('admin.room.create')->withErrors($validator->errors())->withInput();
            }
            $id = $request->id;
            if ($id) {
                $room = Room::find($id)->update($request->all());
                if ($room) {
                    $request->session()->flash('msg', 'Updated Sucessfully!!');
                    return redirect()->route('admin.room.index');
                }
            } else {
                $room = Room::create($request->all());
                if ($room) {
                    $request->session()->flash('msg', 'Created Sucessfully!!');
                    return redirect()->route('admin.room.index');
                }
            }
        } catch (\Illuminate\Database\QueryException $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $room = Room::find($id);
        if ($room) {
            $property = PropertyRegister::all();
            $flattype = FlatType::all();
            return view('backend.admin.pages.rooms.form', compact('property', 'flattype', 'room'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Room::destroy($id);
        return response()->json(['status' => 'Record Deleted Successfully']);
    }
}
