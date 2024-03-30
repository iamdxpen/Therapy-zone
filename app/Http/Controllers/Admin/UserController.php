<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller as Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Role;

class UserController extends Controller
{
    public function __construct() {
        //parent::__construct();
        $this->middleware('permission:user');
    }

    public function index(){
        return View('Admin.User.index');
    }

    public function ajaxList(Request $request, Admin $userObj){
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

        $userCount = $userObj->getAllUsers($searchContents);
        $userData = $userObj->getAllUsers($searchContents, $sort, $limit, $offset);

        $rows = array();
        $iDisplayStart = $request->iDisplayStart;

        $i=1;
        foreach ($userData as $key => $content) {
            $action = '<div class="dropdown">
                <a href="javascript:void(0)" role="button" id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="ri-more-2-fill"></i>
                </a>

                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                    <li><a class="dropdown-item" href="'.route('admin.users.edit', ['id' => $content->id]).'">Edit</a></li>
                    <li><a class="dropdown-item user_remove" href="javascript:void(0)" data-id="' . $content->id . '">Delete</a></li>
                </ul>
            </div>';

            if ($content->status == 'Active') {
                $isActive = '<a href="javascript:void(0)" data-id="' . $content->id . '" class="user_active tooltipped" data-position="top" title="Active"><i class="ri-checkbox-circle-line align-middle text-success fs-16"></i></a>';
            } else {
                $isActive = '<a href="javascript:void(0)" data-id="' . $content->id . '" class="user_inactive tooltipped" data-position="top" title="Inactive"><i class="ri-checkbox-circle-line align-middle text-danger fs-16"></i></a>';
            }

            $rowData = array(
                ($limit * $offset/$limit) + $i,
                '<a href="'.route('admin.users.edit', ['id' => $content->id]).'">'.$content->name.'</a>',
                $content->email,
                $content->getRoleNames(),
                $isActive,
                date("d-m-Y H:i:s",strtotime($content->created_at)),
                $action
            );
            $rows[] = $rowData;
            $i++;
        }

        $json = array(
            'sEcho' => intval($request->sEcho),
            'iTotalRecords' => $userCount,
            'iTotalDisplayRecords' => $userCount,
            'aaData' => $rows
        );

        echo json_encode($json);
    }

    public function add(){
        $roles = Role::checkGuard('admin')->active()->pluck('name','id');
        return View('Admin.User.add', compact('roles'));
    }

    public function store(Request $request){
        $this->validate($request, [
            'name'   => 'required',
            'role'   => 'required',
            'status' => 'required',
            'email' => 'required|email|unique:App\Models\Admin,email',
            'password' => 'required|confirmed'
        ]);

        $userObj = new Admin();
        $userObj->name = $request->name;
        $userObj->email = $request->email;
        $userObj->password = bcrypt($request->password);
        $userObj->status = $request->status;
        if($userObj->save()){
            $userObj->assignRole($request->role);
            return Redirect::route('admin.users')->with('success', 'User added successfully.');
        } else {
            return Redirect::back()->with('error', 'User not added.');
        }
    }

    public function edit($id){
        $user = Admin::find($id);
        if($user && $id != 1){
            $roles = Role::checkGuard('admin')->active()->pluck('name','id');
            return View('Admin.User.edit', compact('user', 'roles'));
        } else {
            return Redirect::route('admin.users')->with('error', 'User not found.');
        }
    }

    public function update($id, Request $request){
        $this->validate($request, [
            'name'   => 'required',
            'role'   => 'required',
            'status' => 'required',
            'email' => 'required|email|unique:App\Models\Admin,email,'.$id,
            'password' => 'confirmed'
        ]);

        $userObj = Admin::find($id);
        if($userObj){
            $userObj->name = $request->name;
            $userObj->email = $request->email;
            $userObj->status = $request->status;

            if($request->password){
                $userObj->password = bcrypt($request->password);
            }

            if($userObj->save()){
                $assignRole = $userObj->getRoleNames()->toArray();
                foreach($assignRole as $key => $val){
                    $userObj->removeRole($val);
                }
                $userObj->assignRole($request->role);
                return Redirect::route('admin.users')->with('success', 'User updated successfully.');
            } else {
                return Redirect::back()->with('error', 'User not updated.');
            }
        } else {
            return Redirect::route('admin.users')->with('success', 'User not found.');
        }
    }

    public function updateStatus(Request $request){
        if($request->has('id') && $request->has('status')) {
            $userObj = Admin::find($request->id);
            $userObj->status = $request->status;
            $userObj->save();
        }
    }

    public function remove(Request $request){
        if($request->has('id')) {
            $userObj = Admin::find($request->id);
            $assignRole = $userObj->getRoleNames()->toArray();
            foreach($assignRole as $key => $val){
                $userObj->removeRole($val);
            }
            $userObj->delete();
        }
    }

    public function checkEmail(Request $request){
        $valid = TRUE;

        if(!empty($request->email)){
            $userObj = Admin::where('email', $request->email);
            if(!empty($request->id)){
                $userObj = $userObj->where('id', '!=', $request->id);    
            }
            $userObj = $userObj->count();
            if($userObj){
                $valid = FALSE;
            }
        } else {
            $valid = FALSE;
        }

        return json_encode(array('valid' => $valid));
    }
}


