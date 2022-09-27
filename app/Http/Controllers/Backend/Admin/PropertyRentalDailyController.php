<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Building;
use App\Models\Checkout;
use App\Models\FlatType;
use App\Models\PropertyRentalDaily;
use App\Models\Room;
use Illuminate\Http\Request;
use PDF;

class PropertyRentalDailyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $propertyrentaldaily = PropertyRentalDaily::with('building')->orderBy('id', 'desc')->get();
        if ($propertyrentaldaily) {
            return view('backend.admin.pages.propertyrentaldaily.index', compact('propertyrentaldaily'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $building = Building::all();
        $flattype = FlatType::all();
        $room = Room::where('status', 1)->get();
        return view('backend.admin.pages.propertyrentaldaily.form', compact('building', 'flattype', 'room'));
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
                $propertyrentaldaily  = propertyrentaldaily::find($id);
                $room_id = $propertyrentaldaily->room_id;
                $propertyrental->update($request->all());
                if ($propertyrentaldaily) {
                    $room = Room::find($room_id);
                    if ($room) {
                        $room->status = !$room->status;
                        $room->save();
                    }
                    $request->session()->flash('msg', 'Updated Sucessfully!!');
                    return redirect()->route('admin.propertyrentaldaily.index');
                }
            } else {
                $propertyrentaldaily = PropertyRentalDaily::create($request->all());
                if ($propertyrentaldaily) {
                    $room_id = $propertyrentaldaily->room_id;
                    $room = Room::find($room_id);
                    if ($room) {
                        $room->status = !$room->status;
                        $room->save();
                    }
                    $request->session()->flash('msg', 'Created Sucessfully!!');
                    return redirect()->route('admin.propertyrentaldaily.index');
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
        $propertyrentaldaily = PropertyRentalDaily::find($id);
        if ($propertyrentaldaily) {
            return view('backend.admin.pages.propertyrentaldaily.show', compact('propertyrentaldaily'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    public function changestatus(Request $request)
    {
        $propertyrentaldaily = PropertyRentalDaily::find($request->id);
        if ($propertyrentaldaily) {
            $propertyrentaldaily->status = !$propertyrentaldaily->status;
            $propertyrentaldaily->save();

            return response()->json(['propertyrentaldaily' => $propertyrentaldaily]);
        }
    }

    public function checkout(Request $request)
    {

        $checkout = Checkout::create($request->all());
    }

    public function pdf(Request $request, $id){
        $propertyrentaldaily = PropertyRentalDaily::find($id);

        return view('backend.admin.pages.propertyrentaldaily.pdf_view', compact('propertyrentaldaily'));
    }

}
