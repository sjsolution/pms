<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\{
    Building,
    Checkout,
    FlatType,
    PropertyRegister,
    PropertyRental,
    Room
};
use Illuminate\Http\Request;
class PropertyRentalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $propertyrental = PropertyRental::where('property_rental',0)->orderBy('id','desc')->get();
        return view('backend.admin.pages.propertyrental.index', compact('propertyrental'));
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
        return view('backend.admin.pages.propertyrental.form', compact('building', 'flattype', 'room'));
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
                $propertyrental  = PropertyRental::find($id);
                $room_id = $propertyrental->room_id;
                $propertyrental->update($request->all());
                if ($propertyrental) {
                    $room = Room::find($room_id);
                    if ($room) {
                        $room->status = !$room->status;
                        $room->save();
                    }
                    $request->session()->flash('msg', 'Updated Sucessfully!!');
                    return redirect()->route('admin.propertyrental.index');
                }
            } else {
                $propertyrental  = PropertyRental::create($request->all());
                if ($propertyrental) {
                    $room_id = $propertyrental->room_id;
                    $room = Room::find($room_id);
                    if ($room) {
                        $room->status = !$room->status;
                        $room->save();
                    }
                    $request->session()->flash('msg', 'Created Sucessfully!!');
                    if($request->property_rental == 0){
                        return redirect()->route('admin.propertyrental.index');
                    }else{
                        return redirect()->route('admin.propertyrentaldaily.index');
                    }
                   
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
        $propertyrentaldaily = PropertyRental::find($id);
        if ($propertyrentaldaily) {
            return view('backend.admin.pages.propertyrental.show', compact('propertyrentaldaily'));
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
        $propertyrental = PropertyRental::find($id);
        if ($propertyrental) {
            $building = Building::all();
            $flattype = FlatType::all();
            $room = Room::where('status', 1)->get();
            return view('backend.admin.pages.propertyrental.form', compact('propertyrental', 'building', 'flattype', 'room'));
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
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        PropertyRental::destroy($id);
        return response()->json(['status' => 'Record Deleted Successfully']);
    }

    public function getroom($id)
    {
        $room = Room::where(['flat_type'=>$id, 'status'=>1])->get();
        if ($room) {
            return response()->json(['room'=>$room]);
        }
    }

    public function changestatus(Request $request)
    {
        $propertyrentaldaily = PropertyRental::find($request->id);
        if ($propertyrentaldaily) {
            $propertyrentaldaily->status = !$propertyrentaldaily->status;
            $propertyrentaldaily->save();

            return response()->json(['propertyrentaldaily' => $propertyrentaldaily]);
        }
    }

    public function checkout(Request $request)
    {
        $propertyid = PropertyRental::find($request->propertyrental_id);
        if($propertyid){
            $propertyid->status = 2;
            $propertyid->save();
            $roomid = $propertyid->room_id;
            $room = Room::find($roomid);
            $room->status = !$room->status;
            $room->save();
            $checkout = Checkout::create($request->all());
            if($checkout){
                return response()->json(['checkout' => $checkout]);
            }
        }
       
    }

    public function pdf(Request $request, $id){
        $propertyrentaldaily = PropertyRental::find($id);

        return view('backend.admin.pages.propertyrental.pdf_view', compact('propertyrentaldaily'));
    }
}
