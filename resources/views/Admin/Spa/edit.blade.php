@extends('Admin.Layouts.master')
@section('page-title', 'Spa Management')

@section('main-content')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Spa Management</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboards</a></li>
                            <li class="breadcrumb-item"><a href="{{route('admin.spa')}}">Spa Management</a></li>
                            <li class="breadcrumb-item active">Update Spa</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        {{ Form::open(['route' => ['admin.spa.update', ['id' => $spa->id]], 'id' => 'silderFrom', 'data-parsley-validate', 'files' => true, 'autocomplete' => 'off']) }}
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Update Spa</h4>
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
                                    <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                                    {{Form::text('title',$spa->title, ['class' => 'form-control', 'placeholder' => 'Enter Title', 'id' => 'title', 'required'])}}
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="mb-3">
                                    <label for="mobile" class="form-label">Mobile <span class="text-danger">*</span></label>
                                    {{Form::text('mobile',$spa->mobile, ['class' => 'form-control', 'placeholder' => 'Enter Mobile', 'id' => 'mobile', 'required'])}}
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                    @php($status = array('Active' => 'Active', 'Inactive' => 'Inactive'))
                                    {{Form::select('status', $status,$spa->status,['class' => 'form-select', 'required'])}}
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-8">
                                <div class="mb-3">
                                    <label for="address" class="form-label">Address<span class="text-danger">*</span></label>
                                    {{Form::text('address',$spa->address, ['class' => 'form-control', 'placeholder' => 'Enter Address', 'id' => 'address', 'required'])}}
                                </div>
                            </div>
                            <div class="col-4">
                                <?php
                                $packages = App\Models\SpaPackage::where('status', 'Active')->get()->pluck('title', 'id');
                                ?>
                                <div class="mb-3">
                                    <label for="package_id" class="form-label">Packages<span class="text-danger">*</span></label>
                                    {{Form::select('package_id', $packages, $spa->package_id,['class' => 'form-select', 'placeholder' => '-please select-','required'])}}
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

        $('#spaFrom').submit(function() {
            $('.vertical-overlay').show(); 
        });
        window.ParsleyValidator.addValidator('display_order', 
            function (value) {
                var valid = false;
                $.ajax({
                    url: '{{route("admin.check-display-order")}}',
                    data: {
                        display_order: value,
                        id: {{$spa->id}},
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