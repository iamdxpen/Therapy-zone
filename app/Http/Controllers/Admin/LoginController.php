<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{
    public function index(){
        return view('Admin.Login.index');
    }

    public function login(Request $request){
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required'
        ]);

        $remember_me = ($request->remember_me)?$request->remember_me:false;
        if (Auth::guard('admin')->attempt([
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'status' => 'Active'    
        ], $remember_me)) {
             return redirect()->route('admin.dashboard');
        } else {
            return redirect()->back()->with('error', "Invalid email and password.");
        }
    }
}
