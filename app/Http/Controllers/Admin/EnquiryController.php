<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller as Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Models\Enquiry;


class EnquiryController extends Controller
{
    public function __construct() {
        //parent::__construct();
        $this->middleware('permission:enquiry');
    }

    public function index(){
        return View('Admin.Enquiry.index');
    }

    public function ajaxList(Request $request, Enquiry $enquiryObj){

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

        $enquiryCount = $enquiryObj->getAllEnquiry($searchContents);
        $enquiryData = $enquiryObj->getAllEnquiry($searchContents, $sort, $limit, $offset);
    
        $rows = array();
        $iDisplayStart = $request->iDisplayStart;

        $i=1;
        foreach ($enquiryData as $key => $content) {

            $action = '<div class="dropdown">
                <a href="javascript:void(0)" role="button" id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="ri-more-2-fill"></i>
                </a>

                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                    <li><a class="dropdown-item enquiry_remove" href="javascript:void(0)" data-id="' . $content->id . '">Delete</a></li>
                </ul>
            </div>';

            $rowData = array(
                $i,
                $content->subject,
                '<a class="enquiry_view" href="javascript:void(0)" data-id="' . $content->id . '">'.$content->name.'</a>',
                $content->email,
                $content->phone,
                $content->country,
                date("d-m-Y H:i:s",strtotime($content->created_at)),
                $action
            );
            $rows[] = $rowData;
            $i++;
        }

        $json = array(
            'sEcho' => intval($request->sEcho),
            'iTotalRecords' => $enquiryCount,
            'iTotalDisplayRecords' => $enquiryCount,
            'aaData' => $rows
        );

        echo json_encode($json);
    }

    public function add(){
    
        return View('Admin.Enquiry.add');
    
    }

    public function store(Request $request){
        
        $this->validate($request, [
            
            'name' => 'required',
            'email'   => 'required',
            'phone'   => 'required|numeric',
            'address'   => 'required',
            'country'   => 'required',
            'city'   => 'required',
            'subject'   => 'required',
            'product'   => 'required',
            'organization'   => 'required',
        ]);
        
        $enquiryObj = new Enquiry();
        $enquiryObj->name = $request->name;
        $enquiryObj->email = $request->email;
        $enquiryObj->phone = $request->phone;
        $enquiryObj->address = $request->address;
        $enquiryObj->country = $request->country;
        $enquiryObj->city = $request->city;
        $enquiryObj->subject = $request->subject;
        $enquiryObj->product = $request->product;
        $enquiryObj->product = $request->product;
        $enquiryObj->organization = $request->organization;
        $enquiryObj->comments = $request->comments;
        if($enquiryObj->save()){
            return redirect()->route('admin.enquiry')->with('success', 'Enquiry added successfully.');
        } else {
            return redirect()->back()->with('error', 'Enquiry not added.');
        }
    }

    public function edit($id){
       
        $enquiry = Enquiry::where('id', $id)->first();
       
        if(!empty($enquiry)){
            return View('Admin.Enquiry.edit', compact('enquiry'));
        }
        else{
            return redirect()->back()->with('error', 'Enquiry not found.');
        }
    }

    public function update($id, Request $request){
        $this->validate($request, [

            'name' => 'required',
            'email'   => 'required',
            'phone'   => 'required|numeric',
            'address'   => 'required',
            'country'   => 'required',
            'city'   => 'required',
            'subject'   => 'required',
            'product'   => 'required',
        ]);

        $enquiryObj = Enquiry::where('id', $id)->first();
        $enquiryObj->name = $request->name;
        $enquiryObj->email = $request->email;
        $enquiryObj->phone = $request->phone;
        $enquiryObj->address = $request->address;
        $enquiryObj->country = $request->country;
        $enquiryObj->city = $request->city;
        $enquiryObj->subject = $request->subject;
        $enquiryObj->product = $request->product;
        $enquiryObj->product_others = $request->product_other;
        $enquiryObj->comments = $request->comments;
        $enquiryObj->status = $request->status;

        if($enquiryObj->save()){ 
                return redirect()->route('admin.enquiry')->with('success', 'Enquiry updated successfully.');
        } else {
                return redirect()->back()->with('error', 'Enquiry not updated.');
        }
        
    }

    public function remove(Request $request){
        
        if($request->has('id')) {
            $enquiryObj = Enquiry::where('id', $request->id)->first();
            $enquiryObj->delete();
            
        }
    }

    public function view(Request $request){
        $data = Enquiry::where('id',$request->id)->first();
        return response()->json($data);
    }


}


