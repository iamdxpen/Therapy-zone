<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller as Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Models\Slider;
use Illuminate\Support\Facades\Storage;


class SliderController extends Controller
{
    public function __construct() {
        //parent::__construct();
        $this->middleware('permission:slider');
    }

    public function index(){
        return View('Admin.Slider.index');
    }

    public function ajaxList(Request $request, Slider $sliderObj){
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

        $sliderCount = $sliderObj->getAllSliders($searchContents);
        $sliderData = $sliderObj->getAllSliders($searchContents, $sort, $limit, $offset);
    
        $rows = array();
        $iDisplayStart = $request->iDisplayStart;

        $i=1;
        foreach ($sliderData as $key => $content) {

            $action = '<div class="dropdown">
                <a href="javascript:void(0)" role="button" id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="ri-more-2-fill"></i>
                </a>

                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                    <li><a class="dropdown-item" href="'.route('admin.slider.edit', ['id' => $content->id]).'">Edit</a></li>
                    <li><a class="dropdown-item slider_remove" href="javascript:void(0)" data-id="' . $content->id . '">Delete</a></li>
                </ul>
            </div>';

            $isActive = '';
            if ($content->status == 'Active') {
                $isActive = '<a href="javascript:void(0)" data-id="' . $content->id . '" class="slider_active tooltipped" data-position="top" title="Active"><i class="ri-checkbox-circle-line align-middle text-success fs-16"></i></a>';
            } else {
                $isActive = '<a href="javascript:void(0)" data-id="' . $content->id . '" class="slider_inactive tooltipped" data-position="top" title="Inactive"><i class="ri-checkbox-circle-line align-middle text-danger fs-16"></i></a>';
            }

            $rowData = array(
                $i,
                '<a href="'.route('admin.slider.edit', ['id' => $content->id]).'">'.$content->title.'</a>',
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
            'iTotalRecords' => $sliderCount,
            'iTotalDisplayRecords' => $sliderCount,
            'aaData' => $rows
        );

        echo json_encode($json);
    }

    public function add(){
    
        $display_order = Slider::latest('display_order')->first();
        if(!empty($display_order)){
            $display_order = $display_order->display_order + 1; 
        }
        else{
            $display_order = 1;
        }
            return View('Admin.Slider.add',compact('display_order'));
    }

    public function store(Request $request){
        
        $this->validate($request, [
            'title' => 'required',
            'image' => 'required|mimes:jpg,png',
            'webp_image' => 'required|mimes:webp',
            'display_order'   => 'required|numeric|unique:App\Models\Slider,display_order',
            'status'   => 'required',
        ]);
        
        $image = $request->image;
        $imagename = NULL;
        if(!empty($image)) {
            $imagename = uploadFile($image, 'sliders');
        }
        $webp_image = $request->webp_image;
        $webp_imagename = NULL;
        if(!empty($webp_image)) {
            $webp_imagename = uploadFile($webp_image, 'sliders');
        }
        $slider = new Slider();
        $slider->title = $request->title;
        $slider->image = $imagename;
        $slider->webp_image = $webp_imagename;
        $slider->display_order = $request->display_order;
        $slider->status = $request->status;
        if($slider->save()){
            return redirect()->route('admin.slider')->with('success', 'Slider added successfully.');
        } else {
            return redirect()->back()->with('error', 'Slider not added.');
        }
    }

    public function edit($id){
       
        $slider = Slider::where('id', $id)->first();
       
        if(!empty($slider)){
            return View('Admin.Slider.edit', compact('slider'));
        }
        else{
            return redirect()->back()->with('error', 'Slider not found.');
        }
    }

    public function update($id, Request $request){
        $this->validate($request, [
            'title' => 'required',
            'image' => 'nullable|mimes:jpg,png',
            'webp_image' => 'nullable|mimes:webp',
            'display_order'   => 'required|numeric|unique:App\Models\Slider,display_order,'.$id,
            'status'   => 'required',
        ]);

        $slider = Slider::where('id', $id)->first();
        if($slider){
            $image = $request->image;
         
            if(!empty($image)) 
            {
                $imagename = uploadFile($image, 'sliders',$slider->image);
                $slider->image = $imagename;
            }

            $webp_image = $request->webp_image;
            if(!empty($webp_image)) {
                $webp_imagename = uploadFile($webp_image, 'sliders',$slider->webp_image);
                $slider->webp_image = $webp_imagename;
            }
            $slider->title = $request->title;
            $slider->display_order = $request->display_order;
            $slider->status = $request->status;
            if($slider->save()){ 
                return redirect()->route('admin.slider')->with('success', 'Slider updated successfully.');
            } else {
                return redirect()->back()->with('error', 'Slider not updated.');
            }
        } else {
            return redirect()->route('admin.slider')->with('success', 'Slider not found.');
        }
    }

    public function updateStatus(Request $request){
        if($request->has('id') && $request->has('status')) {
            $sliderObj = Slider::where('id', $request->id)->first();
            if(!empty($sliderObj)){
                $sliderObj->status = $request->status;
                $sliderObj->save();
            }
        }
    }

    public function remove(Request $request){
        if($request->has('id')) {
            $sliderObj = Slider::where('id', $request->id)->first();
            if ($sliderObj) {
                $imagePath = $sliderObj->image;
                if (!empty($imagePath)) {
                    $filePath = public_path($imagePath);
                    if (file_exists($filePath)) {
                        unlink($filePath);
                    }
                }
                $sliderObj->delete();
            }
        }
    }
    public function displayorder(Request $request){
        $valid = TRUE;

        if(!empty($request->display_order)){
            $sliderObj = Slider::where('display_order', $request->display_order);
            if(!empty($request->id)){
                $sliderObj = $sliderObj->where('id', '!=', $request->id);    
            }
            $sliderObj = $sliderObj->count();
            if($sliderObj){
                $valid = FALSE;
            }
        } else {
            $valid = FALSE;
        }

        return json_encode(array('valid' => $valid));
    }

}


