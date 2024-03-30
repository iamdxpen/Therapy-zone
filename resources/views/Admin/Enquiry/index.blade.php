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
                            <li class="breadcrumb-item active">Enquiry Management</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h5 class="card-title mb-0 flex-grow-1">List all Enquiry</h5>
                        <div class="flex-shrink-0">
                        <!-- <a href="{{route('admin.enquiry.add')}}" class="btn btn-primary btn-label"><i class=" ri-add-line label-icon align-middle fs-16 me-2"></i> Add Enquiry</a> -->
                        </div>
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

                        <table id="enquiryTable" class="display table table-bordered dt-responsive dataTable dtr-inline" style="width:100%">
                            <thead>
                                
                                <tr>
                                    <th>#</th>
                                    <th>Subject</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Country</th>
                                    <th>Created At</th>
                                    <th></th>
                                </tr>
                                 
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div><!--end col-->
        </div>

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
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
<link href="{{asset('assets/libs/sweetalert2/sweetalert2.min.css?v='.env('FILE_VERSION'))}}" rel="stylesheet" type="text/css" />
@endsection

@section('page-js')
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="{{asset('assets/libs/sweetalert2/sweetalert2.min.js?v='.env('FILE_VERSION'))}}"></script>
<script>
    $(function(){
      'use strict'
         var oTable = $('#enquiryTable').DataTable({
            "processing": true,
             "bServerSide": true,
             "sAjaxSource": "{{ route('admin.enquiry.ajax-list') }}", 
             "aaSorting": [ [5, "desc"] ],  
            "iDisplayLength": {{ show_per_page() }},    
            "fnDrawCallback": function (oSettings) {
                feather.replace();
                $('.tooltipped').tooltip({ trigger: "hover" });
            },
             'aoColumns': [
                {'bSortable': false},
                {"class": 'text-center'},
                { "class": 'text-center'},
                {"class": 'text-center'},
                {"class": 'text-center'},
                {"class": 'text-center'},
                {},
                {"class": 'text-center','bSortable': false}
             ],
             language: {
                 searchPlaceholder: 'Search...',
                 sSearch: '',
                 lengthMenu: 'Show _MENU_ Items',
                 
            }
        });
         
    $(document).on('click','.enquiry_remove', function(){
            var idStr = $(this).data('id');
            Swal.fire({
                title: "Are you sure?",
                text: "This enquiry is not display after this action!",
                icon: "warning",
                showCancelButton: !0,
                confirmButtonClass: "btn btn-primary w-xs me-2 mt-2",
                cancelButtonClass: "btn btn-danger w-xs mt-2",
                confirmButtonText: 'Yes, remove pls!',
                cancelButtonText: 'No, cancel!',
                buttonsStyling: !1,
                showCloseButton: !0
            }).then(function(isConfirm) {
                if(isConfirm.value){
                    removeEnquiry(oTable, idStr);
                } else {
                    Swal.fire({
                        title: 'Cancelled',
                        text: 'Your action is safe :)',
                        icon:"error",
                        timer:2e3,
                        timerProgressBar: true,
                        showCancelButton: false,
                        buttonsStyling: !1,
                        showCloseButton: !0,
                        confirmButtonClass: "btn btn-primary mt-2"
                    });
                }
            });
        });

    });

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

    

    function removeEnquiry(oTable, id)
    {
        $('.vertical-overlay').show();
        setTimeout(() => {
            $.ajax({
                url: "{{ route('admin.enquiry.remove') }}",
                data: {id: id, _token: '{{ csrf_token() }}'},
                type: "POST",
                success: function (result) {
                    $('.vertical-overlay').hide();
                    result = result.trim();
                    oTable.draw(false);
                },
                error: function(data){
                    $('.vertical-overlay').hide();
                }
            });
        }, 20);
    }
</script>
@endsection