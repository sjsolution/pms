<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\{User, Building};
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Validations\AdminValidations;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $user = User::where('role', 2)->get();
        if ($user) {
            return view('backend.admin.pages.users.index', compact('user'));
        }
    }

    public function create()
    {
        $building = Building::all();
        $role = Role::all();
        return view('backend.admin.pages.users.form', compact('building', 'role'));
    }

    public function store(Request $request)
    {
        try {
            $validator = AdminValidations::userregister($request);
            if (!empty($validator)) {
                return redirect()->route('admin.user.create')->withErrors($validator->errors())->withInput();
            }
            $id = $request->id;
            if ($id) {
                $user = User::find($id);
                $user->name = $request->name;
                $user->email = $request->email;
                if ($request->password) {
                    $user->password = Hash::make($request->password);
                }
                $user->property_id = $request->property_id;
                $user->role = $request->role;
                $user->save();
                if ($user) {
                    $request->session()->flash('msg', 'Updated Sucessfully!!');
                    return redirect()->route('admin.user.index');
                }
            } else {
                $user = new User();
                $user->name = $request->name;
                $user->email = $request->email;
                $user->password = Hash::make($request->password);
                $user->property_id = $request->property_id;
                $user->role = $request->role;
                $user->save();
                if ($user) {
                    $request->session()->flash('msg', 'Created Sucessfully!!');
                    return redirect()->route('admin.user.index');
                }
            }
        } catch (\Illuminate\Database\QueryException $ex) {
            return $ex->getMessage();
        }
    }

    public function edit(Request $request, $id)
    {
        $user = User::find($id);
        $building = Building::all();
        $role = Role::all();
        if ($user) {
            return view('backend.admin.pages.users.form', compact('user', 'building', 'role'));
        }
    }

    public function destroy(Request $request, $id){
        $user = User::find($id);
        if($user){
            $user->delete();
            return response()->json(['status' => 'Record Deleted Successfully']);
        }

    }
}
