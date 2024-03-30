@extends('Admin.Layouts.master')
@section('page-title', 'Site Setting')

@section('main-content')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Site Setting</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboards</a></li>
                            <li class="breadcrumb-item active">Site Setting</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <form action="{{ route('admin.update-setting') }}" method="POST" id="settingFrom" data-parsley-validate enctype="multipart/form-data" autocomplete="off">
        @csrf
        <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Manage Site Setting</h4>
                </div>
                <div class="card-body">
                    @if(Session::has('error'))
                        <div class="alert alert-danger mb-2" role="alert">{{ Session::get('error') }}</div>
                    @endif

                    @if(Session::has('success'))
                        <div class="alert alert-success mb-2" role="alert">{{ Session::get('success') }}</div>
                    @endif

                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger mb-2" role="alert">{!! $error !!}</div>
                    @endforeach

                    <div class="row">
                        <div class="col-4">
                            <div class="mb-3">
                                <label for="site_title" class="form-label">Site Title <span class="text-danger">*</span></label>
                                <input type="text" name="site_title" class="form-control" placeholder="Enter site title" id="site_title" value="{{ $settingData['site_title'] }}" required>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="mb-3">
                                <label for="show_item_per_page" class="form-label">Select Item Per Page <span class="text-danger">*</span></label>
                                @php($items = array('10' => '10', '25' => '25', '50' => '50', '100' => '100'))
                                <select name="show_item_per_page" class="form-select" required>
                                    @foreach($items as $key => $value)
                                        <option value="{{ $key }}" {{ $key == $settingData['show_item_per_page'] ? 'selected' : '' }}>{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="mb-3">
                                <label for="site_logo" class="form-label">Site Logo</label>
                                @if(!empty($settingData['site_logo']))
                                    <span class="float-end me-1"><small><a href="{{ get_image_url($settingData['site_logo']) }}" target="_blank">View Logo</a></small></span>
                                @endif
                                <input type="file" name="site_logo" class="form-control" placeholder="Upload site logo" id="site_logo">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="reserved_right" class="form-label">Reserved Right <span class="text-danger">*</span></label>
                                <input type="text" name="reserved_right" class="form-control" placeholder="Enter reserved right" id="reserved_right" value="{{ $settingData['reserved_right'] }}" required>
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
</form>

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

        $('#settingFrom').submit(function() {
            $('.vertical-overlay').show(); 
        });
    });
</script>
@endsection