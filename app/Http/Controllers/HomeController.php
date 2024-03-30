<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pages;
use App\Models\Slider;
use App\Models\HomeCategory;
use App\Models\Logo;
use App\Models\Gallery;
use Mail;
use Log;

class HomeController extends Controller
{
    public function index(Request $request){
        $pageObj = Pages::active()->where('slug', 'home')->first();
        $seo = array(
            'title' => !empty($pageObj)?$pageObj->meta_title:get_site_title(),
            'keyword' => !empty($pageObj)?$pageObj->meta_keyword:'',
            'description' => !empty($pageObj)?$pageObj->meta_description:'',
        );

        $sliderImages = Slider::active()->orderBy('display_order', 'ASC')->get();
        $homeCategories = HomeCategory::active()->orderBy('display_order', 'ASC')->get();
        $logos = Logo::active()->orderBy('display_order', 'ASC')->get();
        $galleries = Gallery::active()->orderBy('display_order', 'ASC')->get();

        return view('Home.index', compact('request', 'seo', 'sliderImages', 'homeCategories', 'logos', 'galleries'));
    }

    public function getQuote(Request $request){
        $this->validate($request, [
            'g-recaptcha-response' => 'required|captcha',
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required'
        ]);

        $mailData = array(
            'name' => $request->name,
            'email' => $request->email,
            'request_subject' => $request->subject,
            'request_message' => $request->message
        );

        Log::info('=== Start Get a Quote ===');
        Log::info(json_encode($mailData));
        Log::info('=== End Get a Quote ===');

        Mail::send('Email.thank-you-get-a-quote', $mailData, function($message) use($mailData){
            $message->subject('Thank you for your intereset');
            $message->to($mailData['email']);
        });

        Mail::send('Email.admin-get-a-quote', $mailData, function($message) use($mailData){
            $message->subject('New enquiry received');
            $message->to('info@rubycon.in');
            // $message->to('ajay@multidimension-me.com');
        });

        return redirect()->route('home', ['#getInTouch'])->with('success', 'Thank you, we will contact you soon.');
    }
}
