@extends('Admin.Layouts.master')
@section('page-title', 'Change Password')

@section('main-content')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Change Password</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboards</a></li>
                            <li class="breadcrumb-item"><a href="{{route('admin.profile')}}">Profile</a></li>
                            <li class="breadcrumb-item active">Change Password</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="card">
            <div class="card-header">
                <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('admin.profile')}}">
                            <i class="fas fa-home"></i> Personal Details
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#changePassword" role="tab">
                            <i class="far fa-user"></i> Change Password
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-body p-4">
                <div class="tab-content">
                    <div class="tab-pane active" id="changePassword" role="tabpanel">
                <form action="{{ route('admin.change-password-update') }}" method="POST" id="profileFrom" data-parsley-validate enctype="multipart/form-data" autocomplete="off">
                @csrf
                    @if(Session::has('error'))
                        <div class="alert alert-danger mb-2" role="alert">{{ Session::get('error') }}</div>
                    @endif

                    @if(Session::has('success'))
                        <div class="alert alert-success mb-2" role="alert">{{ Session::get('success') }}</div>
                    @endif

                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger mb-2" role="alert">{!! $error !!}</div>
                    @endforeach

                    <div class="row g-2">
                        <div class="col-lg-4">
                            <div>
                                <label for="current_password" class="form-label">Current Password <span class="text-danger">*</span></label>
                                <input type="password" name="current_password" class="form-control" placeholder="Enter current password" id="current_password" required>
                            </div>
                        </div>
    
                    <div class="col-lg-4">
                        <div>
                            <label for="password" class="form-label">New Password <span class="text-danger">*</span></label>
                            <input type="password" name="password" class="form-control" placeholder="Enter new password" id="password" required>
                        </div>
                    </div>
    
                    <div class="col-lg-4">
                        <div>
                            <label for="password_confirmation" class="form-label">Confirm Password <span class="text-danger">*</span></label>
                            <input type="password" name="password_confirmation" class="form-control" placeholder="Enter confirm password" id="password_confirmation" required data-parsley-equalto="#password" data-parsley-equalto-message="Confirm password should be the same as the new password">
                        </div>
                    </div>
    
                    <div class="col-lg-12">
                        <div class="text-end">
                            <button type="submit" class="btn btn-success">Change Password</button>
                        </div>
                    </div>
    
                </div>

            </form>

                    </div>
                    <!--end tab-pane-->
                </div>
            </div>
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

        $('#profileFrom').submit(function() {
            $('.vertical-overlay').show(); 
        });
    });
</script>
@endsection