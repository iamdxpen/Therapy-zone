<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller as Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission;

class RoleController extends Controller
{
    public function __construct() {
        //parent::__construct();
        $this->middleware('permission:role');
    }
    
    public function index(){
        return View('Admin.Role.index');
    }

    public function ajaxList(Request $request, Role $roleObj){
        $limit = (int)$request->iDisplayLength;
        $offset = (int)$request->iDisplayStart;

        $searchContents['freetext'] = (string)$request->sSearch;
        if ($request->iSortCol_0 != '') {
            for ($i = 0; $i < $request->iSortingCols; $i++) {
                $iSortCol_ = 'iSortCol_' . $i;
                $sSortDir_ = 'sSortDir_' . $i;
                $sortcol = $request->$iSortCol_;
                $sort[$sortcol] = $request->$sSortDir_;
            }
        } else {
            $sort = null;
        }

        $roleCount = $roleObj->getAllRoles($searchContents);
        $roleData = $roleObj->getAllRoles($searchContents, $sort, $limit, $offset);

        $rows = array();
        $iDisplayStart = $request->iDisplayStart;

        $i=1;
        foreach ($roleData as $key => $content) {

            $action = '<div class="dropdown">
                <a href="javascript:void(0)" role="button" id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="ri-more-2-fill"></i>
                </a>

                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                    <li><a class="dropdown-item" href="'.route('admin.roles.edit', ['id' => $content->id]).'">Edit</a></li>
                    <li><a class="dropdown-item role_remove" href="javascript:void(0)" data-id="' . $content->id . '">Delete</a></li>
                </ul>
            </div>';

            $isActive = '';
            if ($content->status == 'Active') {
                $isActive = '<a href="javascript:void(0)" data-id="' . $content->id . '" class="role_active tooltipped" data-position="top" title="Active"><i class="ri-checkbox-circle-line align-middle text-success fs-16"></i></a>';
            } else {
                $isActive = '<a href="javascript:void(0)" data-id="' . $content->id . '" class="role_inactive tooltipped" data-position="top" title="Inactive"><i class="ri-checkbox-circle-line align-middle text-danger fs-16"></i></a>';
            }

            $rowData = array(
                ($limit * $offset/$limit) + $i,
                '<a href="'.route('admin.roles.edit', ['id' => $content->id]).'">'.$content->name.'</a>',
                $isActive,
                date("d-m-Y H:i:s",strtotime($content->created_at)),
                $action
            );
            $rows[] = $rowData;
            $i++;
        }

        $json = array(
            'sEcho' => intval($request->sEcho),
            'iTotalRecords' => $roleCount,
            'iTotalDisplayRecords' => $roleCount,
            'aaData' => $rows
        );

        echo json_encode($json);
    }

    public function add(){
        $permissionsInfo = Permission::checkGuard('admin')->orderBy('display_group')->get();
        $permissions = array();
        foreach($permissionsInfo as $key => $val){
            $permissions[$val->display_group][] = $val;
        }
        
        return View('Admin.Role.add', compact('permissions'));
    }

    public function store(Request $request){
        $this->validate($request, [
            'name'   => 'required|not_in:Superadmin|unique:App\Models\Role,name',
            'status' => 'required',
            'permission.*' => 'required',
        ]);

        $roleObj = new Role();
        $roleObj->name = $request->name;
        $roleObj->status = $request->status;
        $roleObj->guard_name = 'admin';

        if($roleObj->save()){
           $permissions = Permission::where('id',$request->permission)->first();
            $roleObj->syncPermissions($permissions->name);
            return redirect()->route('admin.roles')->with('success', 'Role added successfully.');
        } else {
            return redirect()->back()->with('error', 'Role not added.');
        }
    }

    public function edit($id){
        $role = Role::checkGuard('admin')->where('id', $id)->first();
        if($role){
            $permissionsInfo = Permission::checkGuard('admin')->orderBy('display_group')->get();
            $permissions = array();
            foreach($permissionsInfo as $key => $val){
                $permissions[$val->display_group][] = $val;
            }
            return View('Admin.Role.edit', compact('role', 'permissions'));
        } else {
            return Redirect::route('admin.roles')->with('error', 'Role not found.');
        }
    }

    public function update($id, Request $request){
        $this->validate($request, [
            'name'   => 'required|not_in:Superadmin|unique:App\Models\Role,name,'.$id,
            'status' => 'required',
            'permission.*' => 'required',
        ]);

        $roleObj = Role::checkGuard('admin')->where('id', $id)->first();
        if($roleObj){
            $roleObj->name = $request->name;
            $roleObj->status = $request->status;
            if($roleObj->save()){
                $roleObj->syncPermissions($request->permission);
                return redirect()->route('admin.roles')->with('success', 'Role updated successfully.');
            } else {
                return redirect()->back()->with('error', 'Role not updated.');
            }
        } else {
            return redirect()->route('admin.roles')->with('success', 'Role not found.');
        }
    }

    public function updateStatus(Request $request){
        if($request->has('id') && $request->has('status') && $request->id != 1) {
            $roleObj = Role::checkGuard('admin')->where('id', $request->id)->first();
            if(!empty($roleObj)){
                $roleObj->status = $request->status;
                $roleObj->save();
            }
        }
    }

    public function remove(Request $request){
        if($request->has('id') && $request->id != 1) {
            $roleObj = Role::checkGuard('admin')->where('id', $request->id)->first();
            if(!empty($roleObj)){
                foreach($roleObj->getPermissionNames() as $key => $val){
                    $roleObj->revokePermissionTo($val);
                }
                $roleObj->delete();
            }
        }
    }
}


