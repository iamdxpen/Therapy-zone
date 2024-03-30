<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller as Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Models\HomeCategory;


class HomeCategoryController extends Controller
{
    public function __construct() {
        //parent::__construct();
        $this->middleware('permission:home_category');
    }

    public function index(){
        return View('Admin.HomeCategory.index');
    }

    public function ajaxList(Request $request, HomeCategory $home_categoryObj){
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

        $home_categoryCount = $home_categoryObj->getAllHomeCategories($searchContents);
        $home_categoryData = $home_categoryObj->getAllHomeCategories($searchContents, $sort, $limit, $offset);
    
        $rows = array();
        $iDisplayStart = $request->iDisplayStart;

        $i=1;
        foreach ($home_categoryData as $key => $content) {

            $action = '<div class="dropdown">
                <a href="javascript:void(0)" role="button" id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="ri-more-2-fill"></i>
                </a>

                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                    <li><a class="dropdown-item" href="'.route('admin.home.category.edit', ['id' => $content->id]).'">Edit</a></li>
                    <li><a class="dropdown-item home_category_remove" href="javascript:void(0)" data-id="' . $content->id . '">Delete</a></li>
                </ul>
            </div>';

            $isActive = '';
            if ($content->status == 'Active') {
                $isActive = '<a href="javascript:void(0)" data-id="' . $content->id . '" class="home_category_active tooltipped" data-position="top" title="Active"><i class="ri-checkbox-circle-line align-middle text-success fs-16"></i></a>';
            } else {
                $isActive = '<a href="javascript:void(0)" data-id="' . $content->id . '" class="home_category_inactive tooltipped" data-position="top" title="Inactive"><i class="ri-checkbox-circle-line align-middle text-danger fs-16"></i></a>';
            }

            $rowData = array(
                $i,
                '<a href="'.route('admin.home.category.edit', ['id' => $content->id]).'">'.$content->title.'</a>',
                $content->link,
                $content->display_order,
                $isActive,
                date("d-m-Y H:i:s",strtotime($content->created_at)),
                $action
            );
            $rows[] = $rowData;
            $i++;
        }

        $json = array(
            'sEcho' => intval($request->sEcho),
            'iTotalRecords' => $home_categoryCount,
            'iTotalDisplayRecords' => $home_categoryCount,
            'aaData' => $rows
        );

        echo json_encode($json);
    }

    public function add(){
    
        $display_order = HomeCategory::latest('display_order')->first();
        if(!empty($display_order)){
            $display_order = $display_order->display_order + 1; 
        }
        else{
            $display_order = 1;
        }
            return View('Admin.HomeCategory.add',compact('display_order'));
    }

    public function store(Request $request){
        
        $this->validate($request, [
            'title' => 'required|unique:App\Models\HomeCategory,title,',
            'link' => 'required',
            'display_order'   => 'required|numeric|unique:App\Models\HomeCategory,display_order',
            'status'   => 'required',
        ]);
        
        
        $home_category = new HomeCategory();
        $home_category->title = $request->title;
        $home_category->link = $request->link;
        $home_category->display_order = $request->display_order;
        $home_category->status = $request->status;
        if($home_category->save()){
            return redirect()->route('admin.home.category')->with('success', 'HomeCategory added successfully.');
        } else {
            return redirect()->back()->with('error', 'HomeCategory not added.');
        }
    }

    public function edit($id){
       
        $home_category = HomeCategory::where('id', $id)->first();
       
        if(!empty($home_category)){
            return View('Admin.HomeCategory.edit', compact('home_category'));
        }
        else{
            return redirect()->back()->with('error', 'HomeCategory not found.');
        }
    }

    public function update($id, Request $request){
        $this->validate($request, [
            'title' => 'required|unique:App\Models\HomeCategory,title,'.$id,
            'link' => 'required',
            'display_order'   => 'required|numeric|unique:App\Models\HomeCategory,display_order,'.$id,
            'status'   => 'required',
        ]);

        $home_category = HomeCategory::where('id', $id)->first();
        if($home_category){
            $home_category->title = $request->title;
            $home_category->link = $request->link;
            $home_category->display_order = $request->display_order;
            $home_category->status = $request->status;
            if($home_category->save()){ 
                return redirect()->route('admin.home.category')->with('success', 'HomeCategory updated successfully.');
            } else {
                return redirect()->back()->with('error', 'HomeCategory not updated.');
            }
        } else {
            return redirect()->route('admin.home.category')->with('success', 'HomeCategory not found.');
        }
    }

    public function updateStatus(Request $request){
        if($request->has('id') && $request->has('status')) {
            $home_categoryObj = HomeCategory::where('id', $request->id)->first();
            if(!empty($home_categoryObj)){
                $home_categoryObj->status = $request->status;
                $home_categoryObj->save();
            }
        }
    }

    public function remove(Request $request){
        if($request->has('id')) {
            $home_categoryObj = HomeCategory::where('id', $request->id)->first();
            if ($home_categoryObj) {
                $imagePath = $home_categoryObj->image;
                if (!empty($imagePath)) {
                    $filePath = public_path($imagePath);
                    if (file_exists($filePath)) {
                        unlink($filePath);
                    }
                }
                $home_categoryObj->delete();
            }
        }
    }

    public function displayorder(Request $request){
        $valid = TRUE;

        if(!empty($request->display_order)){
            $home_categoryObj = HomeCategory::where('display_order', $request->display_order);
            if(!empty($request->id)){
                $home_categoryObj = $home_categoryObj->where('id', '!=', $request->id);    
            }
            $home_categoryObj = $home_categoryObj->count();
            if($home_categoryObj){
                $valid = FALSE;
            }
        } else {
            $valid = FALSE;
        }

        return json_encode(array('valid' => $valid));
    }

    public function checkTitle(Request $request){
        $valid = TRUE;

        if(!empty($request->title)){
            $home_categoryObj = HomeCategory::where('title', $request->title);
            if(!empty($request->id)){
                $home_categoryObj = $home_categoryObj->where('id', '!=', $request->id);    
            }
            $home_categoryObj = $home_categoryObj->count();
            if($home_categoryObj){
                $valid = FALSE;
            }
        } else {
            $valid = FALSE;
        }

        return json_encode(array('valid' => $valid));
    }

}


