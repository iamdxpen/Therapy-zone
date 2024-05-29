<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller as Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Models\SpaPackage;
use Illuminate\Support\Facades\Storage;


class SpaPackagesController extends Controller
{
    public function __construct() {
        //parent::__construct();
        $this->middleware('permission:slider');
    }

    public function index(){
        return View('Admin.SpaPackage.index');
    }

    public function ajaxList(Request $request, SpaPackage $spaObj){
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

        $spaCount = $spaObj->getAllSpaPackages($searchContents);
        $spaData = $spaObj->getAllSpaPackages($searchContents, $sort, $limit, $offset);
    
        $rows = array();
        $iDisplayStart = $request->iDisplayStart;

        $i=1;
        foreach ($spaData as $key => $content) {

            $action = '<div class="dropdown">
                <a href="javascript:void(0)" role="button" id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="ri-more-2-fill"></i>
                </a>

                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                    <li><a class="dropdown-item" href="'.route('admin.spa.packages.edit', ['id' => $content->id]).'">Edit</a></li>
                    <li><a class="dropdown-item spa_remove" href="javascript:void(0)" data-id="' . $content->id . '">Delete</a></li>
                </ul>
            </div>';

            $isActive = '';
            if ($content->status == 'Active') {
                $isActive = '<a href="javascript:void(0)" data-id="' . $content->id . '" class="spa_active tooltipped" data-position="top" title="Active"><i class="ri-checkbox-circle-line align-middle text-success fs-16"></i></a>';
            } else {
                $isActive = '<a href="javascript:void(0)" data-id="' . $content->id . '" class="spa_inactive tooltipped" data-position="top" title="Inactive"><i class="ri-checkbox-circle-line align-middle text-danger fs-16"></i></a>';
            }

            $rowData = array(
                $i,
                '<a href="'.route('admin.spa.packages.edit', ['id' => $content->id]).'">'.$content->title.'</a>',
                $content->price,
                $isActive,
                date("d-m-Y H:i:s",strtotime($content->created_at)),
                $action
            );
            $rows[] = $rowData;
            $i++;
        }

        $json = array(
            'sEcho' => intval($request->sEcho),
            'iTotalRecords' => $spaCount,
            'iTotalDisplayRecords' => $spaCount,
            'aaData' => $rows
        );

        echo json_encode($json);
    }

    public function add(){
    
        return View('Admin.SpaPackage.add');
    }

    public function store(Request $request){
        
        $this->validate($request, [
            'title' => 'required',
            'price' => 'required',
            'content' => 'required',
            'status'   => 'required',
        ]);
        
        $spa = new SpaPackage();
        $spa->title = $request->title;
        $spa->price = $request->price;
        $spa->content = $request->content;
        $spa->status = $request->status;
        if($spa->save()){
            return redirect()->route('admin.spa.packages')->with('success', 'SpaPackges added successfully.');
        } else {
            return redirect()->back()->with('error', 'SpaPackges not added.');
        }
    }

    public function edit($id){
       
        $spa = SpaPackage::where('id', $id)->first();
       
        if(!empty($spa)){
            return View('Admin.SpaPackage.edit', compact('spa'));
        }
        else{
            return redirect()->back()->with('error', 'SpaPackges not found.');
        }
    }

    public function update($id, Request $request){
        $this->validate($request, [
            'title' => 'required',
            'price' => 'required',
            'content' => 'required',
            'status'   => 'required',
        ]);

        $spa = SpaPackage::where('id', $id)->first();
        if($spa){
            $spa->title = $request->title;
            $spa->price = $request->price;
            $spa->content = $request->content;
            $spa->status = $request->status;
            if($spa->save()){ 
                return redirect()->route('admin.spa.packages')->with('success', 'Spa updated successfully.');
            } else {
                return redirect()->back()->with('error', 'Spa not updated.');
            }
        } else {
            return redirect()->route('admin.spa.packages')->with('success', 'Spa not found.');
        }
    }

    public function updateStatus(Request $request){
        if($request->has('id') && $request->has('status')) {
            $spaObj = SpaPackage::where('id', $request->id)->first();
            if(!empty($spaObj)){
                $spaObj->status = $request->status;
                $spaObj->save();
            }
        }
    }

    public function remove(Request $request){
        if($request->has('id')) {
            $spaObj = SpaPackage::where('id', $request->id)->first();
            if ($spaObj) {
                $imagePath = $spaObj->image;
                if (!empty($imagePath)) {
                    $filePath = public_path($imagePath);
                    if (file_exists($filePath)) {
                        unlink($filePath);
                    }
                }
                $spaObj->delete();
            }
        }
    }
}


