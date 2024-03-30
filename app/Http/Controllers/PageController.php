<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pages;
use App\Models\Country;
use App\Models\Enquiry;
use Mail;
use Log;

class PageController extends Controller
{
    public function automation(Request $request){
        $pageObj = Pages::active()->where('slug', 'automation')->first();
        $seo = array(
            'title' => !empty($pageObj)?$pageObj->meta_title:get_site_title(),
            'keyword' => !empty($pageObj)?$pageObj->meta_keyword:'',
            'description' => !empty($pageObj)?$pageObj->meta_description:'',
        );
        return view('Page.index', compact('request', 'seo', 'pageObj'));
    }

    public function facilities(Request $request){
        $pageObj = Pages::active()->where('slug', 'facilities')->first();
        $seo = array(
            'title' => !empty($pageObj)?$pageObj->meta_title:get_site_title(),
            'keyword' => !empty($pageObj)?$pageObj->meta_keyword:'',
            'description' => !empty($pageObj)?$pageObj->meta_description:'',
        );
        return view('Page.index', compact('request', 'seo', 'pageObj'));
    }

    public function oems(Request $request){
        $pageObj = Pages::active()->where('slug', 'oems')->first();
        $seo = array(
            'title' => !empty($pageObj)?$pageObj->meta_title:get_site_title(),
            'keyword' => !empty($pageObj)?$pageObj->meta_keyword:'',
            'description' => !empty($pageObj)?$pageObj->meta_description:'',
        );
        return view('Page.index', compact('request', 'seo', 'pageObj'));
    }

    public function contactUs(Request $request){
        $pageObj = Pages::active()->where('slug', 'contact')->first();
        $seo = array(
            'title' => !empty($pageObj)?$pageObj->meta_title:get_site_title(),
            'keyword' => !empty($pageObj)?$pageObj->meta_keyword:'',
            'description' => !empty($pageObj)?$pageObj->meta_description:'',
        );

        $countries = Country::active()->orderBy('name', 'asc')->pluck('name', 'name');

        return view('Page.contact_us', compact('request', 'seo', 'pageObj', 'countries'));
    }

    public function submitContactUs(Request $request){
        $this->validate($request, [
            'g-recaptcha-response' => 'required|captcha',
            'name' => 'required',
            'address' => 'required',
            'city' => 'required',
            'country' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'product' => 'required',
            'comments' => 'required'
        ]);

        $enquiryObj = new Enquiry;
        $enquiryObj->name = $request->name;
        $enquiryObj->address = $request->address;
        $enquiryObj->city = $request->city;
        $enquiryObj->country = $request->country;
        $enquiryObj->phone = $request->phone;
        $enquiryObj->email = $request->email;
        $enquiryObj->subject = $request->subject;
        $enquiryObj->product = $request->product;
        $enquiryObj->comments = $request->comments;

        if(!empty($request->organization)){
            $enquiryObj->organization = $request->organization;
        }

        $enquiryObj->save();

        $mailData = array(
            'enquiry' => $enquiryObj
        );

        Log::info('=== Start Contact Us ===');
        Log::info(json_encode($mailData));
        Log::info('=== End Contact Us ===');

        Mail::send('Email.thank-you-get-in-touch', $mailData, function($message) use($mailData){
            $message->subject('Thank you for your intereset');
            $message->to($mailData['enquiry']->email);
        });

        Mail::send('Email.admin-get-in-touch', $mailData, function($message) use($mailData){
            $message->subject('New enquiry received');
            $message->to('info@rubycon.in');
            // $message->to('ajay@multidimension-me.com');
        });

        return redirect()->route('contact-us')->with('success', 'Thank you, we will contact you soon.');
    }
}
