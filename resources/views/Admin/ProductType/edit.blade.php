@extends('Admin.Layouts.master')
@section('page-title', 'ProductType Management')

@section('main-content')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">ProductType Management</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboards</a></li>
                            <li class="breadcrumb-item"><a href="{{route('admin.product.type')}}">ProductType Management</a></li>
                            <li class="breadcrumb-item active">Update ProductType</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        {{ Form::open(['route' => ['admin.product.type.update', ['id' => $productObj->id]], 'id' => 'productTypeFrom', 'data-parsley-validate', 'files' => true, 'autocomplete' => 'off']) }}
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Update ProductType</h4>
                    </div>
                    <div class="card-body">
                        @if(Session::has('error'))
                        <div class="alert alert-danger mb-2" role="alert">{{ Session::get('error') }}</div>
                        @endif

                        @if(Session::has('success'))
                        <div class="alert alert-success mb-2" role="alert">{{ Session::get('success') }}</div>
                        @endif

                        @foreach ($errors->all() as $error)
                        <div class="alert alert-danger mb-2" role="alert">{!! $errors->first() !!}</div>
                        @endforeach

                        <div class="row">
                            <div class="col-9">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                                    {{Form::text('name',$productObj->name, ['class' => 'form-control', 'placeholder' => 'Enter Name', 'id' => 'name', 'required','data-parsley-name'=>"true", 'data-parsley-name-message'=>"Please provide a unique name"])}}
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                    @php($status = array('Active' => 'Active', 'Inactive' => 'Inactive'))
                                    {{Form::select('status', $status, $productObj->status,['class' => 'form-select', 'required'])}}
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

        $('#productTypeFrom').submit(function() {
            $('.vertical-overlay').show(); 
        });

        window.ParsleyValidator.addValidator('name', 
            function (value) {
                var valid = false;
                $.ajax({
                    url: '{{route("admin.product.type.check-name")}}',
                    data: {
                        name: value,
                        id:{{$productObj->id}},
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