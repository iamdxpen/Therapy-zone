<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller as Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Models\SpaData;
use Illuminate\Support\Facades\Storage;


class SpaDataController extends Controller
{
    public function __construct() {
        //parent::__construct();
        $this->middleware('permission:slider');
    }

    public function index(){
        return View('Admin.SpaData.index');
    }

    public function ajaxList(Request $request, SpaData $customerObj){
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

        $customerCount = $customerObj->getAllSpaData($searchContents);
        $customerData = $customerObj->getAllSpaData($searchContents, $sort, $limit, $offset);
    
        $rows = array();
        $iDisplayStart = $request->iDisplayStart;

        $i=1;
        foreach ($customerData as $key => $content) {

            $action = '<div class="dropdown">
                <a href="javascript:void(0)" role="button" id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="ri-more-2-fill"></i>
                </a>

                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                    <li><a class="dropdown-item customer_remove" href="javascript:void(0)" data-id="' . $content->id . '">Delete</a></li>
                </ul>
            </div>';

            $isActive = '';
            if ($content->status == "Paid") {
                $isActive = '<a href="javascript:void(0)" data-id="' . $content->id . '" class="customer_active tooltipped" data-position="top" title="Active"><i class="ri-checkbox-circle-line align-middle text-success fs-16"></i></a>';
            } else {
                $isActive = '<a href="javascript:void(0)" data-id="' . $content->id . '" class="customer_inactive tooltipped" data-position="top" title="Inactive"><i class="ri-checkbox-circle-line align-middle text-danger fs-16"></i></a>';
            }

            $rowData = array(
                $i,
                isset($content->spa)?$content->spa->title:'-',
                isset($content->spa)?$content->spa->mobile:'-',
                isset($content->spa->package)?$content->spa->package->title:'-',
                isset($content->spa)?$content->customer->name:'-',
                isset($content->spa)?$content->customer->mobile:'-',
                isset($content->customer->package)?$content->customer->package->title:'-',
                $content->code,
                $isActive,
                date("d-m-Y H:i:s",strtotime($content->created_at)),
                $action
            );
            $rows[] = $rowData;
            $i++;
        }

        $json = array(
            'sEcho' => intval($request->sEcho),
            'iTotalRecords' => $customerCount,
            'iTotalDisplayRecords' => $customerCount,
            'aaData' => $rows
        );

        echo json_encode($json);
    }

    public function updateStatus(Request $request){
        if($request->has('id') && $request->has('status')) {
            $customerObj = SpaData::where('id', $request->id)->first();
            if(!empty($customerObj)){
                    $customerObj->status = $request->status;
                }
                $customerObj->save();
            }
    }

    public function remove(Request $request){
        if($request->has('id')) {
            $customerObj = SpaData::where('id', $request->id)->first();
            if ($customerObj) {
                $imagePath = $customerObj->image;
                if (!empty($imagePath)) {
                    $filePath = public_path($imagePath);
                    if (file_exists($filePath)) {
                        unlink($filePath);
                    }
                }
                $customerObj->delete();
            }
        }
    }
   
}