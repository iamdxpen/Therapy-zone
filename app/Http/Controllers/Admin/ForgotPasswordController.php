<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Session;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    public function index(){
        return view('Admin.Login.forgot_password');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $this->validate($request, ['email' => 'required|email']);

        $response = Password::broker('admins')->sendResetLink(
            $request->only('email')
        );

        switch ($response) {
            case Password::RESET_LINK_SENT:
                Session::flash('success', "Reset password link successuly sent to your email address.");
                return Redirect::back();
    
            case Password::INVALID_USER:            
            case Password::INVALID_USER:
            default:
                Session::flash('error', "Please provide valid email address.");
                return Redirect::back();
        }
    }
}
