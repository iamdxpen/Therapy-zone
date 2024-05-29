<?php

if (!function_exists('get_site_title')) {
    function get_site_title()
    {
        $siteTitleObj = App\Models\Setting::select('value')->where('key', 'site_title')->first();
        $siteTitle = '';
        if (!empty($siteTitleObj)) {
            $siteTitle = $siteTitleObj->value;
        }
        return $siteTitle;
    }
}

if (!function_exists('get_site_logo')) {
    function get_site_logo()
    {
        $siteTitleObj = App\Models\Setting::select('value')->where('key', 'site_logo')->first();
        $site_logo = "";
        if (!empty($siteTitleObj) && !empty($siteTitleObj->value)) {
            $site_logo = $siteTitleObj->value;
        }
        return $site_logo;
    }
}

if (!function_exists('get_reserved_right')) {
    function get_reserved_right()
    {
        $reserved_right = '';
        $siteTitleObj = App\Models\Setting::select('value')->where('key', 'reserved_right')->first();

        if (!empty($siteTitleObj)) {
            $reserved_right = $siteTitleObj->value;
        }
        return $reserved_right;
    }
}

if (!function_exists('uploadFile')) {
    function uploadFile($file, $path = '/', $old_path = '')
    {
        if (!empty($old_path)) {
            $old_file_path = str_replace('storage/', '', $old_path);
            Storage::delete($old_file_path);
        }
        
        return 'storage/' . $file->store($path);
    }
}

if (!function_exists('get_setting')) {
    function get_setting($key)
    {
        $returnStr = '-';
        $settingObj = App\Models\Setting::select('value')->where('key', $key)->first();

        if (!empty($settingObj)) {
            $returnStr = $settingObj->value;
        }
        return $returnStr;
    }
}

if (!function_exists('show_per_page')) {
    function show_per_page()
    {
        $show_per_page = 10;
        $siteTitleObj = App\Models\Setting::select('value')->where('key', 'show_item_per_page')->first();

        if (!empty($siteTitleObj)) {
            $show_per_page = $siteTitleObj->value;
        }
        return $show_per_page;
    }
}

if (!function_exists('get_image_url')) {
    function get_image_url($img,$default_image='assets/images/default.png'){
        if(empty($img)){
            return asset($default_image);
        }
        
        return asset($img);
    }
}

if (!function_exists('jsonResponse')) {
    function jsonResponse($status, $data, $message=''){
        $jsonData = array(
            'status' => $status,
            'message' => $message,
            'data' => (object)$data
        );

        return response()->json($jsonData);
    }
}

if (!function_exists('welcome')) {
    function welcome(){
        if(date("H") < 12){
            return "Good Morning";
        }elseif(date("H") > 11 && date("H") < 18){
            return "Good Afternoon";
        }elseif(date("H") > 17){
            return "Good Evening";
        }
    }
}

if (!function_exists('salesEnquiry')) {
    function salesEnquiry(){
        return array(
            'Sales Enquiry' => 'Sales Enquiry',
            'Distributor Enquiry' => 'Distributor Enquiry',
            'OEM Enquiry' => 'OEM Enquiry',
            'General' => 'General',
            'Careers' => 'Careers'
        );
    }
}

if (!function_exists('enquiryProduct')) {
    function enquiryProduct(){
        return array(
            "Industrial" => "Industrial",
            "LED" => "LED",
            "Suspended" => "Suspended",
            "Downlights" => "Downlights",
            "Retail Lighting" => "Retail Lighting",
            "Streetlight / Floodlight / Landscape" => "Streetlight / Floodlight / Landscape",
            "Paintbooth" => "Paintbooth",
            "Others" => "Others"
        );
    }
}