<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller as Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Models\Pages;


class PagesController extends Controller
{
    
    public function __construct() {
        //parent::__construct();
       $this->middleware('permission:pages');
    }
    public function index(){
        return View('Admin.Pages.index');
    }
    public function ajaxList(Request $request, Pages $pagesObj){
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
       
        $pagesCount = $pagesObj->getAllpages($searchContents);
        $pagesData = $pagesObj->getAllpages($searchContents, $sort, $limit, $offset);

        $rows = array();
        $iDisplayStart = $request->iDisplayStart;
        $i=1;
        foreach ($pagesData as $key => $content) {

            $isActive = '';
            if ($content->status == 'Active') {
                $isActive = '<a href="javascript:void(0)" data-id="' . $content->id . '" class="pages_active tooltipped" data-position="top" title="Active"><i class="ri-checkbox-circle-line align-middle text-success fs-16"></i></a>';
            } else {
                $isActive = '<a href="javascript:void(0)" data-id="' . $content->id . '" class="pages_inactive tooltipped" data-position="top" title="Inactive"><i class="ri-checkbox-circle-line align-middle text-danger fs-16"></i></a>';
            }

            $rowData = array(
                $i,
                '<a href="'.route('admin.pages.edit', ['id' => $content->id]).'">'.$content->title.'</a>',
                $isActive,
                date("d-m-Y H:i:s",strtotime($content->created_at))
            );
            $rows[] = $rowData;
            $i++;
        }

        $json = array(
            'sEcho' => intval($request->sEcho),
            'iTotalRecords' => $pagesCount,
            'iTotalDisplayRecords' => $pagesCount,
            'aaData' => $rows
        );

        echo json_encode($json);
    
    }

    public function edit($id){  
      
        $pages = Pages::where('id', $id)->first();
        
        if(!empty($pages)){
            return View('Admin.Pages.edit', compact('pages'));
        }
        else {
            return redirect()->back()->with('error', 'pages not found.');
        }

    }

    public function update($id,Request $request){
        $this->validate($request, [
            'title'   => 'required',
            'status' => 'required',  
        ]);
      
        $pagesObj = Pages::where('id', $id)->first();
        if($pagesObj){
            $pagesObj->title = $request->title;
            $pagesObj->content = $request->content;
            $pagesObj->meta_title = $request->meta_title;
            $pagesObj->meta_keyword = $request->meta_keyword;
            $pagesObj->meta_description = $request->meta_description;
            $pagesObj->status = $request->status;
            if($pagesObj->save()){
                
                return redirect()->route('admin.pages')->with('success', 'pages updated successfully.');
            } else {
                return redirect()->back()->with('error', 'pages not updated.');
            }
        } else {
            return redirect()->route('admin.pages')->with('success', 'pages not found.');
        }
    }

    public function updateStatus(Request $request){
        if($request->has('id') && $request->has('status')) {
            $pagesObj = Pages::where('id', $request->id)->first();
            if(!empty($pagesObj)){
                $pagesObj->status = $request->status;
                $pagesObj->save();
            }
        }
    }

}




