<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Building, FlatType, PropertyRegister, Room};
use Illuminate\Http\Request;
use App\Validations\AdminValidations;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $property = PropertyRegister::with('flatype')->get();
        if ($property) {
            return view('backend.admin.pages.property.index', compact('property'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $flattype = FlatType::all();
        $building = Building::all();
        return view('backend.admin.pages.property.form', compact('flattype', 'building'));
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
            // $validator = AdminValidations::propertyregister($request);
            // if (!empty($validator)) {
            //     return redirect()->route('admin.property.create')->withErrors($validator->errors())->withInput();
            // }
            
            $id = $request->id;
            if ($id) {
                $property = PropertyRegister::find($id);
                if ($request->building_id_append == null) {
                    $property->building_id = $request->select_build_id;
                } else {
                    $property->building_id = $request->building_id_append;
                }
                $property->no_of_flats = $request->no_of_flats;
                $property->flat_type = $request->flat_type;
                $property->flat_id = $request->flat_id;
                $property->save();
                if ($property) {
                    foreach ($request->flat_no as $key => $singleflat) {
                       
                        $room = Room::where([
                            ['property_id',$property->id],
                            ])->first();
                        $room->property_id = $property->id;
                        if ($request->building_id_append == null) {
                            $room->building_id = $request->select_build_id;
                        } else {
                            $room->building_id = $request->building_id_append;
                        }
                        $room->flat_type = $request->flat_type;
                        $room->room_no =  $singleflat;
                        $room->save();
                    }
                    $request->session()->flash('msg', 'Updated Sucessfully!!');
                    return redirect()->route('admin.property.index');
                }
            } else {
                $property = new PropertyRegister();
                if ($request->building_id_append == null) {
                    $property->building_id = $request->select_build_id;
                } else {
                    $property->building_id = $request->building_id_append;
                }
                $property->no_of_flats = $request->no_of_flats;
                $property->save();
                if ($property) {
                    $i = 0;
                    foreach ($request->flat_no as $key => $singleflat) {
                        $room = new Room();
                        $room->property_id = $property->id;
                        if ($request->building_id_append == null) {
                            $room->building_id = $request->select_build_id;
                        } else {
                            $room->building_id = $request->building_id_append;
                        }
                        $room->flat_type = $request->flat_type[$i];
                        $room->room_no =  $singleflat;
                        $room->save();
                        $i++;
                    }
                    $request->session()->flash('msg', 'Created Sucessfully!!');
                    return redirect()->route('admin.property.index');
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
        $property  = PropertyRegister::with('flatype')->find($id);
        $flattype = FlatType::all();
        $building = Building::all();
        $room = Room::where('property_id', $id)->get();
        if ($property) {
            return view('backend.admin.pages.property.form', compact('property', 'flattype', 'building', 'room'));
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
        PropertyRegister::destroy($id);

        return response()->json(['status' => 'Record Deleted Successfully']);
    }
    public function bulkAction(Request $request)
    {
        $status = $request->status;
        $ids = $request->id;
        if ($status == "delete") {
            if (is_array($ids) || is_object($ids)) {
                foreach ($ids as $id) {
                    $data = PropertyRegister::find($id);
                    if ($data) {
                        $data->delete();
                    }
                }
            }
        }
        if ($status == "delete") {
            return redirect()->back()->with('msg', 'Record Deleted Successfully');
        } else {
            return redirect()->back()->with('msg', 'Record Updated Successfully');
        }
    }
    public function update_status(Request $request, $id)
    {
        $property = PropertyRegister::find($id);
        $property->status = !$property->status;
        $property->update();

        return response([
            'status' => $property->status,
        ]);
    }

    public function store_building(Request $request)
    {
        $building = Building::create($request->all());
        if ($building) {
            return response()->json(['building' => $building]);
        }
    }
}
