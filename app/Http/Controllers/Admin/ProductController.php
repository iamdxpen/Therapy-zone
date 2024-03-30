<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller as Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use App\Models\ProductType;
use App\Models\ProductUsage;
use App\Models\ProductUseIn;
use App\Models\ProductUseType;
use App\Models\ProductImage;
use App\Models\TechnicalSpecifications;
use App\Models\ProductTechnicalSpecifications;
use App\Models\ProductOld;
use Session;
use Str;

class ProductController extends Controller
{
    public function __construct() {
        //parent::__construct();
       $this->middleware('permission:product');
    }

    public function index(){
        return View('Admin.Product.index');
    }

    public function ajaxList(Request $request, Product $productObj){

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

        $productCount = $productObj->getAllProducts($searchContents);
        $productData = $productObj->getAllProducts($searchContents, $sort, $limit, $offset);
    
        $rows = array();
        $iDisplayStart = $request->iDisplayStart;

        $i=1;
        foreach ($productData as $key => $content) {

            $action = '<div class="dropdown">
                <a href="javascript:void(0)" role="button" id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="ri-more-2-fill"></i>
                </a>

                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                    <li><a class="dropdown-item" href="'.route('admin.product.edit', ['id' => $content->id]).'">Edit</a></li>
                    <li><a class="dropdown-item product_remove" href="javascript:void(0)" data-id="' . $content->id . '">Delete</a></li>
                </ul>
            </div>';

            $isActive = '';
            if ($content->status == 'Active') {
                $isActive = '<a href="javascript:void(0)" data-id="' . $content->id . '" class="product_active tooltipped" data-position="top" title="Active"><i class="ri-checkbox-circle-line align-middle text-success fs-16"></i></a>';
            } else {
                $isActive = '<a href="javascript:void(0)" data-id="' . $content->id . '" class="product_inactive tooltipped" data-position="top" title="Inactive"><i class="ri-checkbox-circle-line align-middle text-danger fs-16"></i></a>';
            }

            $rowData = array(
                $i,
                $content->name,
                $content->productType->name,
                $isActive,
                date("d-m-Y H:i:s",strtotime($content->created_at)),
                $action
            );
            $rows[] = $rowData;
            $i++;
        }

        $json = array(
            'sEcho' => intval($request->sEcho),
            'iTotalRecords' => $productCount,
            'iTotalDisplayRecords' => $productCount,
            'aaData' => $rows
        );

        echo json_encode($json);
    }

    public function add(){
        $product_type = ProductType::active()->pluck('name','id');
        $product_usage = ProductUsage::active()->pluck('name','id');
        $product_use_in = ProductUseIn::active()->pluck('name','id');
        $product_use_type = ProductUseType::active()->pluck('name','id');
        $technical_specifications = TechnicalSpecifications::active()->get();
        return View('Admin.Product.add',compact('product_type','product_usage','product_use_in','product_use_type','technical_specifications'));
    }

    public function store(Request $request){
        
        $this->validate($request, [
            
            'name' => 'required',
            'image' => 'required|mimes:jpeg,bmp,png',
            'slug'   => 'required|unique:App\Models\Product,slug',
            'product_type'   => 'required',
            'product_used_in'   => 'required',
            'product_use_type'   => 'required',
            'product_usage'   => 'required',
            'device_code'   => 'required',
            'colour'   => 'required',
            'wattage'   => 'required',
            'status'   => 'required',
        ]);
        
        $productObj = new Product();
        $productObj->name = $request->name;
        $productObj->slug = $request->slug;
        $productObj->short_description = $request->short_description;
        $productObj->description = $request->description;
        $productObj->product_type = $request->product_type;
        $productObj->product_used_in = $request->product_used_in;
        $productObj->product_use_type = $request->product_use_type;
        $productObj->product_usage = $request->product_usage;
        $productObj->device_code = $request->device_code;
        $productObj->colour = $request->colour;
        $productObj->wattage = $request->wattage;
        $productObj->meta_title = $request->meta_title;
        $productObj->meta_keyword = $request->meta_keyword;
        $productObj->meta_description = $request->meta_description;
        $productObj->status = $request->status;
        $productObj->save();
        $image = $request->image;
        $imagename = NULL;
        if(!empty($image)) {
            $imagename = uploadFile($image, 'ProductImage');
        }
        $latestDisplayOrder = ProductImage::where('product_id', $productObj->id)->max('display_order');
        $display_order = ($latestDisplayOrder !== null) ? $latestDisplayOrder + 1 : 1;    
        $productimageObj = new ProductImage();
        $productimageObj->product_id = $productObj->id;
        $productimageObj->image = $imagename;
        $productimageObj->display_order = $display_order;
        $productimageObj->is_main = 1;
        if($productimageObj->save()){
            return redirect()->route('admin.product')->with('success', 'Product added successfully.');
        } else {
            return redirect()->back()->with('error', 'Product not added.');
        }
    }

    public function edit($id){
       
        $product = Product::with('images')->find($id);
        if(!empty($product)){
            $product_type = ProductType::active()->pluck('name','id');
            $product_usage = ProductUsage::active()->pluck('name','id');
            $product_use_in = ProductUseIn::active()->pluck('name','id');
            $product_use_type = ProductUseType::active()->pluck('name','id');
            $technical_specifications = TechnicalSpecifications::active()->get();
            return View('Admin.Product.edit', compact('product','product_type','product_usage','product_use_in','product_use_type','technical_specifications'));
        }
        else{
            return redirect()->back()->with('error', 'Product not found.');
        }
    }

    public function update($id, Request $request){
        $this->validate($request, [

            'name' => 'required',
            'slug'   => 'required|unique:App\Models\Product,slug,'.$id,
            'product_type'   => 'required',
            'product_used_in'   => 'required',
            'product_use_type'   => 'required',
            'product_usage'   => 'required',
            'device_code'   => 'required',
            'colour'   => 'required',
            'wattage'   => 'required',
            'status'   => 'required',
        ]);

        $productObj = Product::where('id', $id)->first();
        $productObj->name = $request->name;
        $productObj->slug = $request->slug;
        $productObj->short_description = $request->short_description;
        $productObj->description = $request->description;
        $productObj->product_type = $request->product_type;
        $productObj->product_used_in = $request->product_used_in;
        $productObj->product_use_type = $request->product_use_type;
        $productObj->device_code = $request->device_code;
        $productObj->colour = $request->colour;
        $productObj->wattage = $request->wattage;
        $productObj->product_usage = $request->product_usage;
        $productObj->status = $request->status;
        if($productObj->save()){ 
                return redirect()->back()->with('success', 'Product updated successfully.');
        } else {
                return redirect()->back()->with('error', 'Product not updated.');
        }
        
    }

    public function metainfoupdate($id, Request $request){
        
        $productObj = Product::where('id', $id)->first();
        $productObj->meta_title = $request->meta_title;
        $productObj->meta_keyword = $request->meta_keyword;
        $productObj->meta_description = $request->meta_description;
        if($productObj->save()){ 
                return redirect()->back()->with('success', 'Product updated successfully.');
        } else {
                return redirect()->back()->with('error', 'Product not updated.');
        }
        
    }

    public function imageupdate($id, Request $request){
        $this->validate($request, [

            'image.*' => 'required|mimes:jpeg,bmp,png',
        ]);

        $image = $request->file('image');
        $latestDisplayOrder = ProductImage::where('product_id', $id)->max('display_order');
        $display_order = ($latestDisplayOrder !== null) ? $latestDisplayOrder + 1 : 1;    
        $saveImage = 0;
        foreach($image as $img){
            $imagename = uploadFile($img, 'ProductImage');
            $productimageObj = new ProductImage();
            $productimageObj->product_id = $id;
            $productimageObj->image = $imagename;
            $productimageObj->display_order = $display_order++;
            if ($productimageObj->save()) {
                $saveImage++;
            }
        }
        if($saveImage > 0){
                return redirect()->back()->with('success', 'Product updated successfully.');
        } else {
                return redirect()->back()->with('error', 'Product not updated.');
        }
        
    }


    public function updateStatus(Request $request){
        if($request->has('id') && $request->has('status')) {
            $productObj = Product::where('id', $request->id)->first();
            if(!empty($productObj)){
                $productObj->status = $request->status;
                $productObj->save();
            }
        }
    }

    public function ismainimage(Request $request){
        if($request->has('id')) {
            $productImage = ProductImage::where('id', $request->id)->first();
            if($productImage) {
                $productId = $productImage->product_id;
                ProductImage::where('product_id', $productId)->update(['is_main' => 0]);
                $productImage->is_main = 1;
                $productImage->save();
                Session::flash('success', 'Image Update successfully.');
            }
                
        }
    }

    public function remove(Request $request){
        if ($request->has('id')) {
            $productObj = Product::find($request->id);
            if ($productObj) {
                $imageObjs = ProductImage::where('product_id', $productObj->id)->get();
                foreach ($imageObjs as $imageObj) {
                    $imagePath = $imageObj->image;
                    if (!empty($imagePath)) {
                        $filePath = public_path($imagePath);
                        if (file_exists($filePath)) {
                            unlink($filePath);
                        }
                    }
                    $imageObj->delete();
                }
                $productObj->delete();
            }
        }
    }

    public function imageremove(Request $request){
        if($request->has('id')) {
            $productObj = ProductImage::where('id', $request->id)->first();
            if ($productObj) {
                $imagePath = $productObj->image;
                if (!empty($imagePath)) {
                    $filePath = public_path($imagePath);
                    if (file_exists($filePath)) {
                        unlink($filePath);
                    }
                }
                    $productObj->delete();
                    Session::flash('success', 'Image removed successfully.');
                }
                
        } 
       // Session::flash('error', 'Invalid request.');
    }
        

    public function displayorder(Request $request){
        if($request->has('id') && $request->has('display_order')) {
            $productObj = ProductImage::where('id', $request->id)->first();
            $display_order = ProductImage::where('product_id', $productObj->product_id)
                            ->where('display_order', $request->display_order)
                            ->first();
            if(!empty($display_order)){
                return response()->json(['error' => 'Image Display Order not updated']);
            }
            else{
                $productObj->display_order = $request->display_order;
                $productObj->save();
                return response()->json(['success' => 'Image Display Order updated']);
            }
        }
    }

    public function slug(Request $request){
        $valid = TRUE;

        if(!empty($request->slug)){
            $productObj = Product::where('slug', $request->slug);
            if(!empty($request->id)){
                $productObj = $productObj->where('id', '!=', $request->id);    
            }
            $productObj = $productObj->count();
            if($productObj){
                $valid = FALSE;
            }
        } else {
            $valid = FALSE;
        }

        return json_encode(array('valid' => $valid));
    }

    public function technicalSpecifications(Request $request, $id) {
        $product = Product::find($id); 
        foreach ($request->technical_specifications as $technicalId => $data) {
            if (empty($data['value'])) {
                $existingRecord = ProductTechnicalSpecifications::where('product_id', $product->id)->where('technical_specification_id', $data['id'])->first();
                if ($existingRecord) {
                    $existingRecord->delete();
                }
            } else {
                $existingRecord = ProductTechnicalSpecifications::where('product_id', $product->id)->where('technical_specification_id', $data['id'])->first();
                if ($existingRecord) {
                    $existingRecord->value = $data['value'];
                    $existingRecord->save();
                } else {
                    $technical_specifications = new ProductTechnicalSpecifications();
                    $technical_specifications->product_id = $product->id;
                    $technical_specifications->technical_specification_id = $data['id'];
                    $technical_specifications->value = $data['value'];
                    $technical_specifications->save();
                }
            }
        }
        return redirect()->back()->with('success', 'Technical specifications updated successfully.');
    }

    public function importOld(){
        ini_set('max_execution_time', 0);

        $oldProducts = ProductOld::where('is_active', 'y')->get();
        foreach($oldProducts as $oldProduct){

            $name = $oldProduct->product_name;
            $slug = Str::slug($oldProduct->product_name);
            $short_description = $oldProduct->short_desc;
            $description = $oldProduct->description;
            $meta_title = $oldProduct->product_name;
            $meta_keyword = $oldProduct->meta_keywords;
            $meta_description = $oldProduct->meta_description;

            $product_type='';
            if(!empty($oldProduct->group1)){
                $productType = ProductType::where('name', $oldProduct->group1)->first();
                if(!empty($productType)){
                    $product_type = $productType->id;
                }
            }

            $product_used_in='';
            if(!empty($oldProduct->group2)){
                $productUsedIn = ProductUseIn::where('name', $oldProduct->group2)->first();
                if(!empty($productUsedIn)){
                    $product_used_in = $productUsedIn->id;
                }
            }

            $product_use_type='';
            if(!empty($oldProduct->group3)){
                $productUsedType = ProductUseType::where('name', $oldProduct->group3)->first();
                if(!empty($productUsedType)){
                    $product_use_type = $productUsedType->id;
                }
            }

            $product_usage='';
            if(!empty($oldProduct->group4)){
                $productUsage = ProductUsage::where('name', $oldProduct->group4)->first();
                if(!empty($productUsage)){
                    $product_usage = $productUsage->id;
                }
            }

            $productObj = Product::where('name', $name)->first();
            if(empty($productObj)){
                $productObj = new Product;
                $productObj->status = 'Active';
            }

            $productObj->name = $name;
            $productObj->slug = $slug;
            $productObj->short_description = $short_description;
            $productObj->description = $description;
            $productObj->meta_title = $meta_title;
            $productObj->meta_keyword = $meta_keyword;
            $productObj->meta_description = $meta_description;
            if(!empty($product_type)){
                $productObj->product_type = $product_type;
            }
            if(!empty($product_used_in)){
                $productObj->product_used_in = $product_used_in;
            }
            if(!empty($product_use_type)){
                $productObj->product_use_type = $product_use_type;
            }
            if(!empty($product_usage)){
                $productObj->product_usage = $product_usage;
            }
            $productObj->save();

            $productImages = ProductImage::where('product_id', $productObj->id)->get();
            foreach($productImages as $image){
                $old_file_path = str_replace('storage/', '', $image->image);
                Storage::delete($old_file_path);
            }
            ProductImage::where('product_id', $productObj->id)->delete();
            
            if(!empty($oldProduct->main_image)){
                $url = 'https://rubycon.in/uploads/products/'.$oldProduct->id.'/'.rawurlencode($oldProduct->main_image);
                if (@file_get_contents($url) !== false) {
                    $contents = file_get_contents($url);
                    $name = rawurldecode(time().'_'.substr($url, strrpos($url, '/') + 1));
                    Storage::put('ProductImage/'.$name, $contents);

                    $productimageObj = new ProductImage();
                    $productimageObj->product_id = $productObj->id;
                    $productimageObj->image = 'storage/ProductImage/'.$name;
                    $productimageObj->display_order = 1;
                    $productimageObj->is_main = 1;
                    $productimageObj->save();
                }
            }

            if(!empty($oldProduct->image1)){
                $url = 'https://rubycon.in/uploads/products/'.$oldProduct->id.'/'.rawurlencode($oldProduct->image1);
                if (@file_get_contents($url) !== false) {
                    $contents = file_get_contents($url);
                    $name = rawurldecode(time().'_'.substr($url, strrpos($url, '/') + 1));
                    Storage::put('ProductImage/'.$name, $contents);

                    $productimageObj = new ProductImage();
                    $productimageObj->product_id = $productObj->id;
                    $productimageObj->image = 'storage/ProductImage/'.$name;
                    $productimageObj->display_order = 2;
                    $productimageObj->is_main = 0;
                    $productimageObj->save();
                }
            }

            if(!empty($oldProduct->image2)){
                $url = 'https://rubycon.in/uploads/products/'.$oldProduct->id.'/'.rawurlencode($oldProduct->image2);
                if (@file_get_contents($url) !== false) {
                    $contents = file_get_contents($url);
                    $name = rawurldecode(time().'_'.substr($url, strrpos($url, '/') + 1));
                    Storage::put('ProductImage/'.$name, $contents);

                    $productimageObj = new ProductImage();
                    $productimageObj->product_id = $productObj->id;
                    $productimageObj->image = 'storage/ProductImage/'.$name;
                    $productimageObj->display_order = 3;
                    $productimageObj->is_main = 0;
                    $productimageObj->save();
                }
            }

            if(!empty($oldProduct->image3)){
                $url = 'https://rubycon.in/uploads/products/'.$oldProduct->id.'/'.rawurlencode($oldProduct->image3);
                if (@file_get_contents($url) !== false) {
                    $contents = file_get_contents($url);
                    $name = rawurldecode(time().'_'.substr($url, strrpos($url, '/') + 1));
                    Storage::put('ProductImage/'.$name, $contents);

                    $productimageObj = new ProductImage();
                    $productimageObj->product_id = $productObj->id;
                    $productimageObj->image = 'storage/ProductImage/'.$name;
                    $productimageObj->display_order = 4;
                    $productimageObj->is_main = 0;
                    $productimageObj->save();
                }
            }
        }
    }
}


