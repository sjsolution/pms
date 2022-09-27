<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\FlatType;
use Illuminate\Http\Request;
use App\Validations\AdminValidations;
class FlatTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $flattype = FlatType::all();
        if ($flattype) {
            return view('backend.admin.pages.flat.index', compact('flattype'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.admin.pages.flat.form');
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
            $validator = AdminValidations::flatregister($request);
            if (!empty($validator)) {
                return redirect()->route('admin.flattype.create')->withErrors($validator->errors())->withInput();
            }
            $id = $request->id;
            if ($id) {
                $flattype = FlatType::find($id)->update($request->all());
                if ($flattype) {
                    $request->session()->flash('msg', 'Updated Sucessfully!!');
                    return redirect()->route('admin.flattype.index');
                }
            } else {
                $flattype = FlatType::create($request->all());
                if ($flattype) {
                    $request->session()->flash('msg', 'Created Sucessfully!!');
                    return redirect()->route('admin.flattype.index');
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
        $flattype = FlatType::find($id);
        if ($flattype) {
            return view('backend.admin.pages.flat.form', compact('flattype'));
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
        FlatType::destroy($id);

        return response()->json(['status' => 'Record Deleted Successfully']);
    }
}
