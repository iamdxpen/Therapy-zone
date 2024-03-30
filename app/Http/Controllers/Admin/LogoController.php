<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller as Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Models\Logo;
use Illuminate\Support\Facades\Storage;


class LogoController extends Controller
{
    public function __construct() {
        //parent::__construct();
        $this->middleware('permission:logo');
    }

    public function index(){
        return View('Admin.Logo.index');
    }

    public function ajaxList(Request $request, Logo $logoObj){
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

        $logoCount = $logoObj->getAllLogos($searchContents);
        $logoData = $logoObj->getAllLogos($searchContents, $sort, $limit, $offset);
    
        $rows = array();
        $iDisplayStart = $request->iDisplayStart;

        $i=1;
        foreach ($logoData as $key => $content) {

            $action = '<div class="dropdown">
                <a href="javascript:void(0)" role="button" id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="ri-more-2-fill"></i>
                </a>

                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                    <li><a class="dropdown-item" href="'.route('admin.logo.edit', ['id' => $content->id]).'">Edit</a></li>
                    <li><a class="dropdown-item logo_remove" href="javascript:void(0)" data-id="' . $content->id . '">Delete</a></li>
                </ul>
            </div>';

            $isActive = '';
            if ($content->status == 'Active') {
                $isActive = '<a href="javascript:void(0)" data-id="' . $content->id . '" class="logo_active tooltipped" data-position="top" title="Active"><i class="ri-checkbox-circle-line align-middle text-success fs-16"></i></a>';
            } else {
                $isActive = '<a href="javascript:void(0)" data-id="' . $content->id . '" class="logo_inactive tooltipped" data-position="top" title="Inactive"><i class="ri-checkbox-circle-line align-middle text-danger fs-16"></i></a>';
            }

            $rowData = array(
                $i,
                '<a href="'.route('admin.logo.edit', ['id' => $content->id]).'">'.$content->title.'</a>',
                '<img src="'.get_image_url($content->image).'" width = "50px" >',
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
            'iTotalRecords' => $logoCount,
            'iTotalDisplayRecords' => $logoCount,
            'aaData' => $rows
        );

        echo json_encode($json);
    }

    public function add(){
    
        $display_order = Logo::latest('display_order')->first();
        if(!empty($display_order)){
            $display_order = $display_order->display_order + 1; 
        }
        else{
            $display_order = 1;
        }
            return View('Admin.Logo.add',compact('display_order'));
    }

    public function store(Request $request){
        
        $this->validate($request, [
            'title' => 'required',
            'image' => 'required|mimes:jpg,png',
            'webp_image' => 'required|mimes:webp',
            'display_order'   => 'required|numeric|unique:App\Models\Logo,display_order',
            'status'   => 'required',
        ]);
        
        $image = $request->image;
        $imagename = NULL;
        if(!empty($image)) {
            $imagename = uploadFile($image, 'logo');
        }
        $webp_image = $request->webp_image;
        $webp_imagename = NULL;
        if(!empty($webp_image)) {
            $webp_imagename = uploadFile($webp_image, 'logo');
        }
        $logo = new Logo();
        $logo->title = $request->title;
        $logo->image = $imagename;
        $logo->webp_image = $webp_imagename;
        $logo->display_order = $request->display_order;
        $logo->status = $request->status;
        if($logo->save()){
            return redirect()->route('admin.logo')->with('success', 'Logo added successfully.');
        } else {
            return redirect()->back()->with('error', 'Logo not added.');
        }
    }

    public function edit($id){
       
        $logo = Logo::where('id', $id)->first();
       
        if(!empty($logo)){
            return View('Admin.Logo.edit', compact('logo'));
        }
        else{
            return redirect()->back()->with('error', 'Logo not found.');
        }
    }

    public function update($id, Request $request){
        $this->validate($request, [
            'title' => 'required',
            'image' => 'nullable|mimes:jpg,png',
            'webp_image' => 'nullable|mimes:webp',
            'display_order'   => 'required|numeric|unique:App\Models\Logo,display_order,'.$id,
            'status'   => 'required',
        ]);

        $logo = Logo::where('id', $id)->first();
        if($logo){
            $image = $request->image;
         
            if(!empty($image)) 
            {
                $imagename = uploadFile($image, 'galleries',$logo->image);
                $logo->image = $imagename;
            }

            $webp_image = $request->webp_image;
            if(!empty($webp_image)) {
                $webp_imagename = uploadFile($webp_image, 'galleries',$logo->webp_image);
                $logo->webp_image = $webp_imagename;
            }
            $logo->title = $request->title;
            $logo->display_order = $request->display_order;
            $logo->status = $request->status;
            if($logo->save()){ 
                return redirect()->route('admin.logo')->with('success', 'Logo updated successfully.');
            } else {
                return redirect()->back()->with('error', 'Logo not updated.');
            }
        } else {
            return redirect()->route('admin.logo')->with('success', 'Logo not found.');
        }
    }

    public function updateStatus(Request $request){
        if($request->has('id') && $request->has('status')) {
            $logoObj = Logo::where('id', $request->id)->first();
            if(!empty($logoObj)){
                $logoObj->status = $request->status;
                $logoObj->save();
            }
        }
    }

    public function remove(Request $request){
        if($request->has('id')) {
            $logoObj = Logo::where('id', $request->id)->first();
            if ($logoObj) {
                $imagePath = $logoObj->image;
                if (!empty($imagePath)) {
                    $filePath = public_path($imagePath);
                    if (file_exists($filePath)) {
                        unlink($filePath);
                    }
                }
                $logoObj->delete();
            }
        }
    }
    public function displayorder(Request $request){
        $valid = TRUE;

        if(!empty($request->display_order)){
            $logoObj = Logo::where('display_order', $request->display_order);
            if(!empty($request->id)){
                $logoObj = $logoObj->where('id', '!=', $request->id);    
            }
            $logoObj = $logoObj->count();
            if($logoObj){
                $valid = FALSE;
            }
        } else {
            $valid = FALSE;
        }

        return json_encode(array('valid' => $valid));
    }

}


