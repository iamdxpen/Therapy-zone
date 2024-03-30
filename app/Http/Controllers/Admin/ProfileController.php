<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Auth;
use Hash;

class ProfileController extends Controller
{
    public function __construct() {
    }

    public function index(){
        return View('Admin.Profile.index');
    }

    public function update(Request $request){
        $this->validate($request, [
            'name' => 'required'
        ]);

        $user_id = Auth::guard('admin')->User()->id;
        $obj_user = Admin::find($user_id);
        $obj_user->name = $request->name;
        $obj_user->save();

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }

    public function change_password(){
        return View('Admin.Profile.change_password');
    }

    public function update_password(Request $request)
    {
        $this->validate($request, [
            'current_password' => 'required',
            'password' => 'required|confirmed'
        ]);

        $current_password = Auth::guard('admin')->User()->password;
        if(Hash::check($request->current_password, $current_password))
        {           
            $user_id = Auth::guard('admin')->User()->id;
            $obj_user = Admin::find($user_id);
            $obj_user->password = Hash::make($request->password);
            $obj_user->save();
            return redirect()->back()->with('success', 'Password updated successfully.');
        }
        else
        {
            return redirect()->back()->withErrors(['Please enter correct current password.']);
        }
    }
}
