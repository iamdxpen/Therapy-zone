@extends('Admin.Layouts.master')
@section('page-title', 'Customer Management')

@section('main-content')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Customer Management</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboards</a></li>
                            <li class="breadcrumb-item"><a href="{{route('admin.customer')}}">Customer Management</a></li>
                            <li class="breadcrumb-item active">Update Customer</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        {{ Form::open(['route' => ['admin.customer.update', ['id' => $customer->id]], 'id' => 'silderFrom', 'data-parsley-validate', 'files' => true, 'autocomplete' => 'off']) }}
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Update Customer</h4>
                    </div>
                    <div class="card-body">
                        @if(Session::has('error'))
                        <div class="alert alert-danger mb-2" category="alert">{{ Session::get('error') }}</div>
                        @endif

                        @if(Session::has('success'))
                        <div class="alert alert-success mb-2" category="alert">{{ Session::get('success') }}</div>
                        @endif

                        @foreach ($errors->all() as $error)
                        <div class="alert alert-danger mb-2" category="alert">{!! $errors->first() !!}</div>
                        @endforeach

                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                                    {{Form::text('name',$customer->name, ['class' => 'form-control', 'placeholder' => 'Enter Title', 'id' => 'name', 'required'])}}
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="mb-3">
                                    <label for="mobile" class="form-label">Mobile <span class="text-danger">*</span></label>
                                    {{Form::text('mobile',$customer->mobile, ['class' => 'form-control', 'placeholder' => 'Enter Mobile', 'id' => 'mobile', 'required'])}}
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                    @php($status = array('Active' => 'Active', 'Inactive' => 'Inactive'))
                                    {{Form::select('status', $status,$customer->status,['class' => 'form-select', 'required'])}}
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <?php
                                $packages = App\Models\CustomerPackage::where('status', 'Active')->get()->pluck('title', 'id');
                                ?>
                                <div class="mb-3">
                                    <label for="package_id" class="form-label">Packages<span class="text-danger">*</span></label>
                                    {{Form::select('package_id', $packages, $customer->package_id,['class' => 'form-select', 'placeholder' => '-please select-','required'])}}
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="mb-3">
                                    <label for="is_vip_customer" class="form-label">Payment Screenshot Approve <span class="text-danger">*</span></label>
                                    @php($is_vip_customer = array('1' => 'Yes', '0' => 'No'))    
                                    {{Form::select('is_vip_customer', $is_vip_customer,$customer->is_vip_customer,['class' => 'form-select', 'required'])}}
                                    @if(!empty($customer->payment_image))
                                    <a href="{{asset($customer->payment_image)}}" target="_blank">View Image</a></small></span>
                                    @endif
                                </div>
                            </div>
                            @if(!empty($customer->is_vip_customer == 1))
                            <div class="col-3">
                                <div class="mb-3">
                                    <label for="code_value" class="form-label">How Much Code Genarate <span class="text-danger">*</span></label>
                                    {{Form::text('code_value','', ['class' => 'form-control', 'placeholder' => 'Enter code value', 'id' => 'code_value'])}}
                                </div>
                            </div>
                            @endif
                            <a target="_blank" href="https://api.whatsapp.com/send?phone={{ $customer->mobile }}" role="button"></i>Send Code On whatsapp</a>
                        </div>
                        
                        <div class="row">
                            <div class="col-12">
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end col-->
        </div>
        {{ Form::close() }}
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h5 class="card-title mb-0 flex-grow-1">List all Code</h5>
                    </div>
                    <div class="card-body">
                        <table id="customerTable" class="display table table-bordered dt-responsive dataTable dtr-inline" style="width:100%">
                            <thead>
                                
                                <tr>
                                    <th>Code</th>
                                    <th>Status</th>
                                </tr>
                                 
                            </thead>
                            <tbody>
                                @if(!empty($codeObj))
                                @foreach($codeObj as $code)
                                <tr>
                                    <td>{{ $code->code }}</td>
                                    <td>{{ $code->status }}</td>
                                </tr>
                                @endforeach
                                @endif
                                <tr>
                                    <td class="text-center" colspan="2">No Code Available</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div><!--end col-->
        </div>

    </div>
    <!-- container-fluid -->
</div>
@endsection

@section('page-css')
@endsection

@section('page-js')
<script>
    $(function(){
        'use strict'

        $('#customerFrom').submit(function() {
            $('.vertical-overlay').show(); 
        });
        window.ParsleyValidator.addValidator('display_order', 
            function (value) {
                var valid = false;
                $.ajax({
                    url: '{{route("admin.check-display-order")}}',
                    data: {
                        display_order: value,
                        id: {{$customer->id}},
                        _token: "{{ csrf_token() }}"
                    },
                    type: 'POST',
                    dataType: "JSON",
                    async: false,
                    success: function(response) {
                        valid = response.valid;
                    }
                });
                return valid;
            },
        32);
  
    });
</script>
@endsection