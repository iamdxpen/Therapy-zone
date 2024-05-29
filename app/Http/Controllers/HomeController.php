<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{


    public function index()
    {
        return view('frontend.home');
    }
    public function aboutUs()
    {
        return view('frontend.about-us'); 
    }

    public function services()
    {
        return view('frontend.services');
    }
}