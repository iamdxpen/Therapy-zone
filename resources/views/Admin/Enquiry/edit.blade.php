@extends('Admin.Layouts.master')
@section('page-title', 'Enquiry Management')

@section('main-content')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Enquiry Management</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboards</a></li>
                            <li class="breadcrumb-item"><a href="{{route('admin.enquiry')}}">Enquiry Management</a></li>
                            <li class="breadcrumb-item active">Update Enquiry</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        {{ Form::open(['route' => ['admin.enquiry.update', ['id' => $enquiry->id]], 'id' => 'enquiryFrom', 'data-parsley-validate', 'files' => true, 'autocomplete' => 'off']) }}
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Update Enquiry</h4>
                    </div>
                    <div class="card-body">
                        @if(Session::has('error'))
                        <div class="alert alert-danger mb-2" enquiry="alert">{{ Session::get('error') }}</div>
                        @endif

                        @if(Session::has('success'))
                        <div class="alert alert-success mb-2" enquiry="alert">{{ Session::get('success') }}</div>
                        @endif

                        @foreach ($errors->all() as $error)
                        <div class="alert alert-danger mb-2" enquiry="alert">{!! $errors->first() !!}</div>
                        @endforeach

                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                                    {{Form::text('name',$enquiry->name, ['class' => 'form-control', 'placeholder' => 'Enter Name', 'id' => 'name', 'required'])}}
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                    {{Form::email('email',$enquiry->email, ['class' => 'form-control', 'placeholder' => 'Enter Email', 'id' => 'email', 'required'])}}
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone <span class="text-danger">*</span></label>
                                    {{Form::number('phone',$enquiry->phone, ['class' => 'form-control', 'placeholder' => 'Enter Phone', 'id' => 'phone', 'required'])}}
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="address" class="form-label">Address<span class="text-danger">*</span></label>
                                    {{Form::text('address',$enquiry->address, ['class' => 'form-control', 'placeholder' => 'Enter Address', 'id' => 'address', 'required'])}}
                                </div>
                            </div>
                            <div class="col-3">
                                <?php
                                $country = App\Models\Country::where('status', 'Active')->get()->pluck('name', 'name');
                                ?>
                                <div class="mb-3">
                                    <label for="country" class="form-label">Country<span class="text-danger">*</span></label>
                                    {{Form::select('country', $country,$enquiry->country,['class' => 'form-select', 'placeholder' => '-please select-','required'])}}
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="mb-3">
                                    <label for="city" class="form-label">City<span class="text-danger">*</span></label>
                                    {{Form::text('city',$enquiry->city, ['class' => 'form-control', 'placeholder' => 'Enter City', 'id' => 'city', 'required'])}}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <div class="mb-3">
                                    <label for="subject" class="form-label">Subject <span class="text-danger">*</span></label>
                                    @php($subject = array('Sales Enquiry' => 'Sales Enquiry', 'Distributor Enquiry' => 'Distributor Enquiry','OEM Enquiry' => 'OEM Enquiry','General' => 'General','Creers' => 'Creers'))
                                    {{Form::select('subject', $subject,$enquiry->subject,['class' => 'form-select', 'placeholder' => '-please select-', 'required'])}}
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="mb-3">
                                    <label for="product" class="form-label">Product <span class="text-danger">*</span></label>
                                    @php($product = array('Industrial' => 'Industrial', 'LED' => 'LED', 'Suspended' => 'Suspended', 'Downlights' => 'Downlights', 'Retail Lighting' => 'Retail Lighting', 'Streetlight ' => 'Streetlight ', 'Paintbooth' => 'Paintbooth', 'Others' => 'Others'))
                                    {{Form::select('product', $product,$enquiry->product,['class' => 'form-select', 'placeholder' => '-please select-','required'])}}
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="mb-3">
                                    <label for="product_other" class="form-label">Product Other </label>
                                    {{Form::text('product_other',$enquiry->product_others, ['class' => 'form-control', 'placeholder' => 'Enter Product other', 'id' => 'product_other'])}}
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="mb-3">
                                    <label for="organization" class="form-label">Organization<span class="text-danger">*</span></label>
                                    {{Form::text('organization',$enquiry->organization, ['class' => 'form-control', 'placeholder' => 'Enter Organization', 'id' => 'organization','required'])}}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="comments" class="form-label">Comments </label>
                                    {{Form::textarea('comments',$enquiry->comments, ['class' => 'form-control', 'placeholder' => 'Enter Comments', 'id' => 'comments'])}}
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                    @php($status = array('Active' => 'Active', 'Inactive' => 'Inactive'))
                                    {{Form::select('status', $status, $enquiry->status,['class' => 'form-select', 'required'])}}
                                </div>
                            </div>
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
            <!--end col-->
        </div>
        {{ Form::close() }}

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

        $('#enquiryFrom').submit(function() {
            $('.vertical-overlay').show(); 
        });
    });
</script>
@endsection