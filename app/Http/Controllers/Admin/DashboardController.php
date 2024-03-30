<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Permission;
use App\Models\Role;
use App\Models\Enquiry;
use App\Models\Product;
use Auth;
use DB;
use Artisan;

class DashboardController extends Controller
{
    public function index(Request $request){
        $from_date = '';
        $to_date = '';
        if(!empty($request->date)){
            $dates = explode(' to ', $request->date);
            if(!empty($dates[0])){
                $from_date = date('Y-m-d 00:00:00', strtotime($dates[0]));
            }
            if(!empty($dates[1])){
                $to_date = date('Y-m-d 23:59:59', strtotime($dates[1]));
            }
        }
        $ProductsCount = Product::count();
        $EnquiryCount = Enquiry::count();
        $today =  date('Y-m-d');
        $EnquiryToday = Enquiry::whereDate('created_at', $today)->get();
        
        return view('Admin.Dashboard.index', compact('request','ProductsCount','EnquiryCount','EnquiryToday'));
    }

    public function logout(){
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }

    public function syncPermission(){

        $permissions = Permission::defaultAdminPermissions();

        $allInsertedPermission = Permission::checkGuard('admin')->get();
        foreach($allInsertedPermission as $aKey => $aVal){
            $found = 0;
            foreach($permissions as $key => $val){
                if($aVal->name == $val['role']){
                    $found = 1;
                }
            }

            if($found == 0){
                DB::table('role_has_permissions')->where('permission_id', $aVal->id)->delete();
                DB::table('model_has_permissions')->where('permission_id', $aVal->id)->delete();
                $aVal->delete();
            }
        }

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'display_group' => $permission['group'],
                'display_name' => $permission['name'],
                'name' => $permission['role'],
                'guard_name' => $permission['guard']
            ]);
        }

        $roles_array = array('Superadmin');
        foreach($roles_array as $role) {
            $roleObj = Role::firstOrCreate(['name' => trim($role), 'guard_name' => 'admin']);
            $roleObj->syncPermissions(Permission::where('guard_name', 'admin')->get());
        }

        Artisan::call('permission:cache-reset');

        echo 'Done';
    }
}
