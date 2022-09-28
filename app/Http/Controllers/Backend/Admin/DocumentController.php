<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Document;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $document = Document::orderBy('id', 'desc')->get();
        if ($document) {
            return view('backend.admin.pages.document.index', compact('document'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.admin.pages.document.form');
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
            $id = $request->id;
            if ($id) {
                $docuemt = Document::find($id);
                $docuemt->user_id = $request->user_id;
                $docuemt->title = $request->title;
                $docuemt->description = $request->description;
                if ($request->image) {
                    $image = image($request);
                    $docuemt->image = $image;
                }
                $docuemt->expiry_date = $request->expiry_date;
                $docuemt->days_alert = $request->days_alert;
                $docuemt->save();
                if ($docuemt) {
                    $request->session()->flash('msg', 'Updated Sucessfully!!');
                    return redirect()->route('admin.document.index');
                }
            } else {
                $docuemt = new Document();
                $docuemt->user_id = $request->user_id;
                $docuemt->title = $request->title;
                $docuemt->description = $request->description;
                if ($request->image) {
                    $image = image($request);
                    $docuemt->image = $image;
                }
                $docuemt->expiry_date = $request->expiry_date;
                $docuemt->days_alert = $request->days_alert;
                $docuemt->save();
                if ($docuemt) {
                    $request->session()->flash('msg', 'Created Sucessfully!!');
                    return redirect()->route('admin.document.index');
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
        $document = Document::find($id);
        if ($document) {
            return view('backend.admin.pages.document.form', compact('document'));
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
        Document::destroy($id);
        return response()->json(['status' => 'Record Deleted Successfully']);
    }
}
