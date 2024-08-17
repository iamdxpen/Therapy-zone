<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Spa;
use App\Models\CustomerPackage;
use App\Models\Customer;
use App\Models\CustomerCode;
use App\Models\SpaData;
class HomeController extends Controller
{


    public function index()
    {
        $spaObj = Spa::where('status','=','Active')->get();
        $packageObj = CustomerPackage::where('status','=','Active')->get();
        return view('frontend.home',compact('spaObj','packageObj'));
    }
    public function aboutUs()
    {
        return view('frontend.about-us'); 
    }

    public function services()
    {
        return view('frontend.services');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'mobile_number' => 'required|string|max:20',
            'screenshot' => 'nullable|image|max:2048',
            'package_id' => 'required'
        ]);

        $customerObj = new Customer;
        $customerObj->name = $request->name;
        $customerObj->email = $request->email;
        $customerObj->mobile = $request->mobile_number;
        $customerObj->package_id = $request->package_id;
        if(!empty($request->screenshot)){
            $screenshot_request = $request->file('screenshot');
            if(!empty($screenshot_request)) {
                $logo_name = uploadFile($screenshot_request, 'screenshot');
                $customerObj->payment_image = $logo_name;
            }
        }
        $customerObj->save();
        return redirect()->back()->with('success', 'Customer created successfully.');
    }
    
    public function code()
    {
        return view('Admin.Customer.code');
    }

    public function storeCode(Request $request)
    {
        $this->validate($request, [
            'spa' => 'required',
            'customer' => 'required',
            'code' => 'required'
        ]);
        $status = 'NotUse';
        $codeObj = CustomerCode::where('customer_id',$request->customer)->where('code',$request->code)->where('status',$status)->first();
        if(!empty($codeObj)){
            $codeObj->status = "Used";
            $codeObj->save();
            $spaObj = new SpaData();
            $spaObj->customer_id = $request->customer;
            $spaObj->spa_id = $request->spa;
            $spaObj->code = $request->code; 
            $spaObj->save();
            return redirect()->route('code')->with('success', 'Customer Code successfully verify.');
        } else {
            return redirect()->back()->with('error', 'Customer not found.');
        }
    }
}