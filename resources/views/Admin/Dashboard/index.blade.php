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
        
        <div class="row">
                <div class="col-xl-4 col-md-6">
                    <!-- card -->
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 overflow-hidden">
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0"> Total Products</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="{{ $ProductsCount }}">0</span> </h4>
                                    <a href="{{ route('admin.product') }}" class="text-decoration-underline">View All</a>
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-soft-success rounded fs-3">
                                        <i class="ri-shopping-cart-fill text-success"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->

                <div class="col-xl-4 col-md-6">
                    <!-- card -->
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 overflow-hidden">
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Total Enquiries</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="{{ $EnquiryCount }}">0</span></h4>
                                    <a href="{{ route('admin.enquiry') }}" class="text-decoration-underline">View all</a>
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-soft-info rounded fs-3">
                                        <i class="ri-chat-1-line text-info"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->

                <div class="col-xl-4 col-md-6">
                    <!-- card -->
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 overflow-hidden">
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Today Enquiries</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="{{ $EnquiryToday->count() }}">0</span> </h4>
                                    <a href="#" class="text-decoration-underline view-all-link">View All</a>
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-soft-warning rounded fs-3">
                                        <i class="ri-chat-1-line text-warning"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->
            </div> <!-- end row-->
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Today Enquiries</h4>
                        <div class="flex-shrink-0">
                        <a href="{{ route('admin.enquiry') }}" class="btn btn-soft-info btn-sm">
                            <i class="ri-file-list-3-line align-middle"></i> View All
                        </a>
                        </div>
                    </div><!-- end card header -->

                    <div class="card-body" id="enquiry-table-section">
                        <div class="table-responsive table-card">
                            <table class="table table-borderless table-centered align-middle table-nowrap mb-0">
                                <thead class="text-muted table-light">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Subject</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Phone</th>
                                        <th scope="col">Country</th>
                                        <th scope="col">Created At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @php
                                $i = 1;
                                @endphp
                                @if ($EnquiryToday->isEmpty())
                                    <tr>
                                        <td colspan="7" class="text-center">No data available in table.</td>
                                    </tr>
                                @else
                                @foreach($EnquiryToday  as $Enquiry)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $Enquiry->subject }}</td>
                                        <td><a class="enquiry_view" href="javascript:void(0)" data-id= "{{ $Enquiry->id }}" >{{ $Enquiry->name }}</a></td>
                                        <td>{{ $Enquiry->email }}</td>
                                        <td>{{ $Enquiry->phone }}</td>
                                        <td>{{ $Enquiry->country }}</td>
                                        <td>{{ $Enquiry->created_at }}</td>
                                    </tr>
                                @endforeach   
                                @endif 
                                </tbody><!-- end tbody -->
                            </table><!-- end table -->
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
    <div class="modal fade" id="enquiryview" tabindex="-1" aria-labelledby="exampleModalgridLabel" aria-modal="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalgridLabel">Enquiry View</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <div class="table-responsive">
                    <table class="table mb-0">
                        <tbody>
                            <tr>
                                <th scope="row" style="width: 200px;">Name</th>
                                <td> <span id="name_data"></span></td>
                            </tr>
                            <tr>
                                <th scope="row">Email</th>
                                <td><span id="email_data"></span></td>
                            </tr>
                            <tr>
                                <th scope="row">Phone</th>
                                <td><span id="phone_data"></span></td>
                            </tr>
                            <tr>
                                <th scope="row">Address</th>
                                <td><span id="address_data"></span></td>
                            </tr>
                            <tr>
                                <th scope="row">City</th>
                                <td><span id="city_data"></span></td>
                            </tr>
                            <tr>
                                <th scope="row">Country</th>
                                <td> <span id="country_data"></span></td>
                            </tr>
                            <tr>
                                <th scope="row">Subject</th>
                                <td><span id="subject_data"></span></td>
                            </tr>
                            <tr>
                                <th scope="row">Organization</th>
                                <td><span id="organization_data"></span></td>
                            </tr>
                            <tr>
                                <th scope="row">Product</th>
                                <td><span id="product_data"></span></td>
                            </tr>
                            <tr>
                                <th scope="row">Other Products</th>
                                <td><span id="product_others_data"></span></td>
                            </tr>
                            <tr>
                                <th scope="row">Comments</th>
                                <td><span id="comments_data"></span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
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

        $(document).on('click','.enquiry_view', function(){
        var id = $(this).data('id');
            $.ajax({     
                data: {id: id},
                type: "GET",
                dataType: "json",
                url:"{{ route('admin.enquiry.enuiryview') }}",
                success: function(data){ 
                    $("#name_data").text(data.name);
                    $("#email_data").text(data.email);
                    $("#phone_data").text(data.phone);
                    $("#address_data").text(data.address);
                    $("#country_data").text(data.country);
                    $("#city_data").text(data.city);
                    $("#subject_data").text(data.subject);
                    $("#organization_data").text(data.organization);
                    $("#product_data").text(data.product);
                    $("#product_others_data").text(data.product_others);
                    $("#comments_data").text(data.comments);
                    $("#enquiryview").modal('show');
                }
            });
    });

    $(document).ready(function () {
        $(".view-all-link").click(function (event) {
            event.preventDefault();

            var targetOffset = $("#enquiry-table-section").offset().top;

            $("html, body").animate({
                scrollTop: targetOffset
            }, 800);
        });
    });

});
</script>
@endsection