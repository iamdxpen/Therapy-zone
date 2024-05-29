<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use Auth;
use Storage;

class SettingController extends Controller
{
    public function __construct() {
       $this->middleware(['permission:site-setting']);
    }

    public function index(){
        $settingData = Setting::getAllSetting();
        return View('Admin.Setting.index', compact('settingData'));
    }

    public function update(Request $request){
        $this->validate($request, [
            'site_title' => 'required',
            'reserved_right' => 'required',
            'show_item_per_page' => 'required'
        ]);

        Setting::where('key','site_title')->update(
            [
                'value' => $request->site_title
            ]
        );

        Setting::where('key','reserved_right')->update(
            [
                'value' => $request->reserved_right
            ]
        );

        Setting::where('key','show_item_per_page')->update(
            [
                'value' => $request->show_item_per_page
            ]
        );

        if(!empty($request->site_logo)){
            $old_logo = Setting::getSettingByKey('site_logo');
            $old_logo = !empty($old_logo)?$old_logo->value:'';

            $site_logo_image = $request->file('site_logo');
            $site_logo_image_name = NULL;
            if(!empty($site_logo_image)) {
                $site_logo_image_name = uploadFile($site_logo_image, 'logo', $old_logo);
            }
            
            Setting::where('key','site_logo')->update(
                [
                    'value' => $site_logo_image_name
                ]
            );
        }

        return redirect()->back()->with('success', 'Settings updated successfully.');
    }
}
