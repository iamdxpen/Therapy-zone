@extends('Admin.Layouts.master')
@section('page-title', 'Role Management')

@section('main-content')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Role Management</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboards</a></li>
                            <li class="breadcrumb-item"><a href="{{route('admin.roles')}}">Role Management</a></li>
                            <li class="breadcrumb-item active">Update Role</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        {{ Form::open(['route' => ['admin.roles.update', ['id' => $role->id]], 'id' => 'roleFrom', 'data-parsley-validate', 'files' => true, 'autocomplete' => 'off']) }}
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Update Role</h4>
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
                                    {{Form::text('name', $role->name, ['class' => 'form-control', 'placeholder' => 'Enter role name', 'id' => 'name', 'required'])}}
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                    @php($status = array('Active' => 'Active', 'Inactive' => 'Inactive'))
                                    {{Form::select('status', $status, $role->status,['class' => 'form-select', 'required'])}}
                                </div>
                            </div>
                        </div>

                        <div class="border mt-3 border-dashed mb-4"></div>

                        <div class="row">
                            <div class="col-12">
                                <div id="cbWrapper" class="parsley-checkbox w-100">
                                    <div class="row">
                                    @foreach ($permissions as $pKey => $pVal)
                                        <div class="col-3 mb-4">
                                            <p class="text-muted fw-medium mb-2">{{$pKey}}</p>
                                            @foreach($pVal as $key => $val)
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{$val->id}}" <?php if($key == 0){ ?> data-parsley-mincheck="1" data-parsley-class-handler="#cbWrapper" data-parsley-errors-container="#cbErrorContainer" required="" data-parsley-required-message="Please select at least one permission." <?php } ?> data-parsley-multiple="permission" id="p{{$val->id}}" <?php if(in_array($val->name, $role->getPermissionNames()->toArray())){ echo 'checked'; } ?>>
                                                <label class="form-check-label" for="p{{$val->id}}">{{$val->display_name}}</label>
                                            </div>
                                            @endforeach
                                        </div>
                                    @endforeach
                                    </div>
                                </div>
                                <div id="cbErrorContainer"></div>
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

        $('#roleFrom').submit(function() {
            $('.vertical-overlay').show(); 
        });
    });
</script>
@endsection