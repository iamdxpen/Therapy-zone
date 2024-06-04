@extends('Admin.Layouts.master')
@section('page-title', 'Dashboard')

@section('main-content')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Dashboard</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->
        @can('dashboard')
        <div class="row">
            <div class="col">
                <div class="h-100">
                    <div class="row mb-3 pb-1">
                        <div class="col-12">
                            <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                                <div class="flex-grow-1">
                                    <h4 class="fs-16 mb-1">{{welcome()}}!</h4>
                                    <p class="text-muted mb-0">Here is your personalized dashboard.</p>
                                </div>                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>   
        
        
    </div> 
</div>
@endcan

    @cannot('dashboard')
    <div class="row">
        <div class="col-12">
            <div class="card card-body text-center py-2 align-items-center justify-content-center card-403">
                <h1>403</h1>
                <p class="card-text text-muted">Forbidden or no permission to access, Please contact your administrrator.</p>
            </div>
        </div>
    </div>
    @endcan

    </div>
</div>
@endsection

@section('page-css')
<!-- jsvectormap css -->
<link href="{{asset('assets/libs/jsvectormap/css/jsvectormap.min.css?v='.env('FILE_VERSION'))}}" rel="stylesheet" type="text/css" />

<!--Swiper slider css-->
<link href="{{asset('assets/libs/swiper/swiper-bundle.min.css?v='.env('FILE_VERSION'))}}" rel="stylesheet" type="text/css" />
@endsection

@section('page-js')
<!-- apexcharts -->
<script src="{{asset('assets/libs/apexcharts/apexcharts.min.js?v='.env('FILE_VERSION'))}}"></script>

<!-- Vector map-->
<script src="{{asset('assets/libs/jsvectormap/js/jsvectormap.min.js?v='.env('FILE_VERSION'))}}"></script>
<script src="{{asset('assets/libs/jsvectormap/maps/world-merc.js?v='.env('FILE_VERSION'))}}"></script>

<!--Swiper slider js-->
<script src="{{asset('assets/libs/swiper/swiper-bundle.min.js?v='.env('FILE_VERSION'))}}"></script>

<!-- Dashboard init -->
<script src="{{asset('assets/js/pages/dashboard-ecommerce.init.js?v='.env('FILE_VERSION'))}}"></script>

<script>
    $(function(){
        'use strict'
    });
</script>
@endsection