@extends('Admin.Layouts.master')
@section('page-title', 'Profile')

@section('main-content')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Profile</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboards</a></li>
                            <li class="breadcrumb-item active">Profile</li>
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
                        <a class="nav-link active" data-bs-toggle="tab" href="#personalDetails" role="tab">
                            <i class="fas fa-home"></i> Personal Details
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('admin.change-password')}}">
                            <i class="far fa-user"></i> Change Password
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-body p-4">
                <div class="tab-content">
                    <div class="tab-pane active" id="personalDetails" role="tabpanel">
                    <form action="{{ route('admin.profile-update') }}" method="POST" id="profileForm" enctype="multipart/form-data" data-parsley-validate autocomplete="off">
                            @csrf
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
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" value="{{ Auth::guard('admin')->user()->name }}" required>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email Address</label>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" value="{{ Auth::guard('admin')->user()->email }}" required disabled>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="hstack gap-2 justify-content-end">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </div>
                                <!--end col-->
                            </div>
                            <!--end row-->
                        </form>

                    </div>
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

        $('#profileForm').submit(function() {
            $('.vertical-overlay').show(); 
        });
    });
</script>
@endsection