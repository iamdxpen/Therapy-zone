<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pages;
use App\Models\ProductType;
use App\Models\ProductUseIn;
use App\Models\ProductUseType;
use App\Models\ProductUsage;
use App\Models\Product;
use Mail;
use Log;

class ProductController extends Controller
{
    public function index(Request $request){
        $pageObj = Pages::active()->where('slug', 'products')->first();
        $seo = array(
            'title' => !empty($pageObj)?$pageObj->meta_title:get_site_title(),
            'keyword' => !empty($pageObj)?$pageObj->meta_keyword:'',
            'description' => !empty($pageObj)?$pageObj->meta_description:'',
        );

        $productTypes = ProductType::active()->get();
        $productUsedIn = ProductUseIn::active()->get();
        $productUsedType = ProductUseType::active()->get();
        $productUsage = ProductUsage::active()->get();

        $products = Product::active();
        
        if(!empty($request->type)){
            $products->whereHas('productType', function($q) use($request){
                $q->where('name', $request->type);
            });
        }

        if(!empty($request->used_id)){
            $products->whereHas('productUseIn', function($q) use($request){
                $q->where('name', $request->used_id);
            });
        }

        if(!empty($request->used_type)){
            $products->whereHas('productUseType', function($q) use($request){
                $q->whereIn('name', $request->used_type);
            });
        }

        if(!empty($request->usage)){
            $products->whereHas('productUsage', function($q) use($request){
                $q->whereIn('name', $request->usage);
            });
        }

        if(empty($request->order_by) || $request->order_by == 'latest'){
            $products->orderBy('id','DESC');
        } else if($request->order_by == 'old'){
            $products->orderBy('id','ASC');
        }
        
        $products = $products->paginate(12);

        return view('Product.index', compact('request','seo','productTypes','productUsedIn','productUsedType','productUsage','products'));
    }

    public function detail($slug){
        $product = Product::active()->where('slug', $slug)->first();
        if(empty($product)){
            return abort(404);
        }

        $seo = array(
            'title' => !empty($product->meta_title)?$product->meta_title:get_site_title(),
            'keyword' => !empty($product->meta_keyword)?$product->meta_keyword:'',
            'description' => !empty($product->meta_description)?$product->meta_description:'',
        );

        return view('Product.detail', compact('product','seo'));
    }

    public function sendEnquiry(Request $request){
        $this->validate($request, [
            'g-recaptcha-response' => 'required|captcha',
            'name' => 'required',
            'email' => 'required|email',
            'product' => 'required',
            'message' => 'required'
        ]);

        $mailData = array(
            'name' => $request->name,
            'email' => $request->email,
            'request_subject' => 'Enquiry for '.$request->product,
            'request_message' => $request->message
        );

        Log::info('=== Start Product Quote ===');
        Log::info(json_encode($mailData));
        Log::info('=== End Product Quote ===');

        Mail::send('Email.thank-you-get-a-quote', $mailData, function($message) use($mailData){
            $message->subject('Thank you for your intereset');
            $message->to($mailData['email']);
        });

        Mail::send('Email.admin-get-a-quote', $mailData, function($message) use($mailData){
            $message->subject('New enquiry received');
            $message->to('info@rubycon.in');
            // $message->to('ajay@multidimension-me.com');
        });

        return redirect()->back()->with('success', 'Thank you, we will contact you soon.');
    }
}
