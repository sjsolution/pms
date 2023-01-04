<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Building;
use App\Validations\AdminValidations;
use Illuminate\Http\Request;

class BuildingController extends Controller
{
    public function index()
    {
        $buildings = Building::all();
        return view('backend.admin.pages.building.index', compact('buildings'));
    }

    public function create()
    {
        return view('backend.admin.pages.building.form');
    }

    public function store(Request $request)
    {
        try {
            $validator = AdminValidations::buildingregister($request);
            if (!empty($validator)) {
                return redirect()->route('admin.building.create')->withErrors($validator->errors())->withInput();
            }
            $id = $request->id;
            if ($id) {
                $building = Building::find($id)->update($request->all());
                if ($building) {
                    $request->session()->flash('msg', 'Updated Sucessfully!!');
                    return redirect()->route('admin.building.index');
                }
            } else {
                $building = Building::create($request->all());
                if ($building) {
                    $request->session()->flash('msg', 'Created Sucessfully!!');
                    return redirect()->route('admin.building.index');
                }
            }
        } catch (\Illuminate\Database\QueryException $ex) {
            return $ex->getMessage();
        }
    }

    public function edit(Request $request, $id)
    {
        $building = Building::find($id);
        if ($building) {
            return view('backend.admin.pages.building.form', compact('building'));
        }
    }

    public function destroy(Request $request, $id){
        $building = Building::find($id);
        if ($building && $building->building()->count() < 1) {
            $building->delete();
            return response()->json(['status' => 'Record Deleted Successfully']);
        }
        else{
            return response()->json(['error' => 'Record already used it cant be deleted']);
        }
    }
}
