<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller as Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\CustomerCode;
use Illuminate\Support\Facades\Storage;


class CustomerController extends Controller
{
    public function __construct() {
        //parent::__construct();
        $this->middleware('permission:slider');
    }

    public function index(){
        return View('Admin.Customer.index');
    }

    public function ajaxList(Request $request, Customer $customerObj){
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

        $customerCount = $customerObj->getAllCustomers($searchContents);
        $customerData = $customerObj->getAllCustomers($searchContents, $sort, $limit, $offset);
    
        $rows = array();
        $iDisplayStart = $request->iDisplayStart;

        $i=1;
        foreach ($customerData as $key => $content) {

            $action = '<div class="dropdown">
                <a href="javascript:void(0)" role="button" id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="ri-more-2-fill"></i>
                </a>

                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                    <li><a class="dropdown-item" href="'.route('admin.customer.edit', ['id' => $content->id]).'">Edit</a></li>
                    <li><a class="dropdown-item customer_remove" href="javascript:void(0)" data-id="' . $content->id . '">Delete</a></li>
                </ul>
            </div>';

            $isActive = '';
            if ($content->status == 'Active') {
                $isActive = '<a href="javascript:void(0)" data-id="' . $content->id . '" class="customer_active tooltipped" data-position="top" title="Active"><i class="ri-checkbox-circle-line align-middle text-success fs-16"></i></a>';
            } else {
                $isActive = '<a href="javascript:void(0)" data-id="' . $content->id . '" class="customer_inactive tooltipped" data-position="top" title="Inactive"><i class="ri-checkbox-circle-line align-middle text-danger fs-16"></i></a>';
            }

            $rowData = array(
                $i,
                '<a href="'.route('admin.customer.edit', ['id' => $content->id]).'">'.$content->name.'</a>',
                $content->mobile,
                $content->package->title,
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

    public function add(){
        return View('Admin.Customer.add');
    }

    public function store(Request $request){
        
        $this->validate($request, [
            'name' => 'required',
            'mobile' => 'required',
            'package_id' => 'required',
            'status'   => 'required',
        ]);
        
        $customer = new Customer();
        $customer->name = $request->name;
        $customer->mobile =$request->mobile;
        $customer->package_id = $request->package_id;
        $customer->status = $request->status;
        if($customer->save()){
            return redirect()->route('admin.customer')->with('success', 'Customer added successfully.');
        } else {
            return redirect()->back()->with('error', 'Customer not added.');
        }
    }

    public function edit($id){
       
        $customer = Customer::where('id', $id)->first();
        if(!empty($customer)){
            $codeObj = CustomerCode::where('customer_id',$customer->id)->get();
            return View('Admin.Customer.edit', compact('customer','codeObj'));
        }
        else{
            return redirect()->back()->with('error', 'Customer not found.');
        }
    }

    public function update($id, Request $request){
        $this->validate($request, [
            'name' => 'required',
            'mobile' => 'required',
            'package_id' => 'required',
            'status'   => 'required',
            'is_vip_customer' => 'required',
        ]);

        $customer = Customer::where('id', $id)->first();
        if($customer){
            $customer->name = $request->name;
            $customer->mobile =$request->mobile;
            $customer->package_id = $request->package_id;
            $customer->status = $request->status;
            $customer->is_vip_customer = $request->is_vip_customer;
            if($request->is_vip_customer == 1 && !empty($request->code_value)){
                $keys = generateUniqueKeys($request->code_value);
                foreach($keys as $key){
                    $codeObj = new CustomerCode;
                    $codeObj->code = $key;
                    $codeObj->customer_id = $customer->id;
                    $codeObj->save();
                }
            }
            if($customer->save()){ 
                return redirect()->route('admin.customer')->with('success', 'Customer updated successfully.');
            } else {
                return redirect()->back()->with('error', 'Customer not updated.');
            }
        } else {
            return redirect()->route('admin.customer')->with('success', 'Customer not found.');
        }
    }

    public function updateStatus(Request $request){
        if($request->has('id') && $request->has('status')) {
            $customerObj = Customer::where('id', $request->id)->first();
            if(!empty($customerObj)){
                $customerObj->status = $request->status;
                $customerObj->save();
            }
        }
    }

    public function remove(Request $request){
        if($request->has('id')) {
            $customerObj = Customer::where('id', $request->id)->first();
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
    public function displayorder(Request $request){
        $valid = TRUE;

        if(!empty($request->display_order)){
            $customerObj = Customer::where('display_order', $request->display_order);
            if(!empty($request->id)){
                $customerObj = $customerObj->where('id', '!=', $request->id);    
            }
            $customerObj = $customerObj->count();
            if($customerObj){
                $valid = FALSE;
            }
        } else {
            $valid = FALSE;
        }

        return json_encode(array('valid' => $valid));
    }

}


