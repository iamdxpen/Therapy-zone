<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller as Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Models\Gallery;
use Illuminate\Support\Facades\Storage;


class GalleryController extends Controller
{
    public function __construct() {
        //parent::__construct();
        $this->middleware('permission:gallery');
    }

    public function index(){
        return View('Admin.Gallery.index');
    }

    public function ajaxList(Request $request, Gallery $gallery){
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

        $galleryCount = $gallery->getAllGalleries($searchContents);
        $galleryData = $gallery->getAllGalleries($searchContents, $sort, $limit, $offset);
    
        $rows = array();
        $iDisplayStart = $request->iDisplayStart;

        $i=1;
        foreach ($galleryData as $key => $content) {

            $action = '<div class="dropdown">
                <a href="javascript:void(0)" role="button" id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="ri-more-2-fill"></i>
                </a>

                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                    <li><a class="dropdown-item" href="'.route('admin.gallery.edit', ['id' => $content->id]).'">Edit</a></li>
                    <li><a class="dropdown-item gallery_remove" href="javascript:void(0)" data-id="' . $content->id . '">Delete</a></li>
                </ul>
            </div>';

            $isActive = '';
            if ($content->status == 'Active') {
                $isActive = '<a href="javascript:void(0)" data-id="' . $content->id . '" class="gallery_active tooltipped" data-position="top" title="Active"><i class="ri-checkbox-circle-line align-middle text-success fs-16"></i></a>';
            } else {
                $isActive = '<a href="javascript:void(0)" data-id="' . $content->id . '" class="gallery_inactive tooltipped" data-position="top" title="Inactive"><i class="ri-checkbox-circle-line align-middle text-danger fs-16"></i></a>';
            }

            $rowData = array(
                $i,
                '<a href="'.route('admin.gallery.edit', ['id' => $content->id]).'">'.$content->title.'</a>',
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
            'iTotalRecords' => $galleryCount,
            'iTotalDisplayRecords' => $galleryCount,
            'aaData' => $rows
        );

        echo json_encode($json);
    }

    public function add(){
    
        $display_order = Gallery::latest('display_order')->first();
        if(!empty($display_order)){
            $display_order = $display_order->display_order + 1; 
        }
        else{
            $display_order = 1;
        }
            return View('Admin.Gallery.add',compact('display_order'));
    }

    public function store(Request $request){
        
        $this->validate($request, [
            'title' => 'required',
            'image' => 'required|mimes:jpg,png',
            'webp_image' => 'required|mimes:webp',
            'display_order'   => 'required|numeric|unique:App\Models\Gallery,display_order',
            'status'   => 'required',
        ]);
        
        $image = $request->image;
        $imagename = NULL;
        if(!empty($image)) {
            $imagename = uploadFile($image, 'galleries');
        }
        $webp_image = $request->webp_image;
        $webp_imagename = NULL;
        if(!empty($webp_image)) {
            $webp_imagename = uploadFile($webp_image, 'galleries');
        }
        $gallery = new Gallery();
        $gallery->title = $request->title;
        $gallery->image = $imagename;
        $gallery->webp_image = $webp_imagename;
        $gallery->display_order = $request->display_order;
        $gallery->status = $request->status;
        if($gallery->save()){
            return redirect()->route('admin.gallery')->with('success', 'Gallery added successfully.');
        } else {
            return redirect()->back()->with('error', 'Gallery not added.');
        }
    }

    public function edit($id){
       
        $gallery = Gallery::where('id', $id)->first();
       
        if(!empty($gallery)){
            return View('Admin.Gallery.edit', compact('gallery'));
        }
        else{
            return redirect()->back()->with('error', 'Gallery not found.');
        }
    }

    public function update($id, Request $request){
        $this->validate($request, [
            'title' => 'required',
            'image' => 'nullable|mimes:jpg,png',
            'webp_image' => 'nullable|mimes:webp',
            'display_order'   => 'required|numeric|unique:App\Models\Gallery,display_order,'.$id,
            'status'   => 'required',
        ]);

        $gallery = Gallery::where('id', $id)->first();
        if($gallery){
            $image = $request->image;
         
            if(!empty($image)) 
            {
                $imagename = uploadFile($image, 'galleries',$gallery->image);
                $gallery->image = $imagename;
            }

            $webp_image = $request->webp_image;
            if(!empty($webp_image)) {
                $webp_imagename = uploadFile($webp_image, 'galleries',$gallery->webp_image);
                $gallery->webp_image = $webp_imagename;
            }
            $gallery->title = $request->title;
            $gallery->display_order = $request->display_order;
            $gallery->status = $request->status;
            if($gallery->save()){ 
                return redirect()->route('admin.gallery')->with('success', 'Gallery updated successfully.');
            } else {
                return redirect()->back()->with('error', 'Gallery not updated.');
            }
        } else {
            return redirect()->route('admin.gallery')->with('success', 'Gallery not found.');
        }
    }

    public function updateStatus(Request $request){
        if($request->has('id') && $request->has('status')) {
            $gallery = Gallery::where('id', $request->id)->first();
            if(!empty($gallery)){
                $gallery->status = $request->status;
                $gallery->save();
            }
        }
    }

    public function remove(Request $request){
        if($request->has('id')) {
            $gallery = Gallery::where('id', $request->id)->first();
            if ($gallery) {
                $imagePath = $gallery->image;
                if (!empty($imagePath)) {
                    $filePath = public_path($imagePath);
                    if (file_exists($filePath)) {
                        unlink($filePath);
                    }
                }
                $gallery->delete();
            }
        }
    }
    public function displayorder(Request $request){
        $valid = TRUE;

        if(!empty($request->display_order)){
            $gallery = Gallery::where('display_order', $request->display_order);
            if(!empty($request->id)){
                $gallery = $gallery->where('id', '!=', $request->id);    
            }
            $gallery = $gallery->count();
            if($gallery){
                $valid = FALSE;
            }
        } else {
            $valid = FALSE;
        }

        return json_encode(array('valid' => $valid));
    }

}


