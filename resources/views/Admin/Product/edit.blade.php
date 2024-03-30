@extends('Admin.Layouts.master')
@section('page-title', 'Product Management')

@section('main-content')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Product Management</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboards</a></li>
                            <li class="breadcrumb-item"><a href="{{route('admin.product')}}">Product Management</a></li>
                            <li class="breadcrumb-item active">Update Product</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-xxl-12">
            <div class="card mt-xxl-n12">
                <div class="card-header">
                    <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#productupdate" role="tab">
                                <i class="fas fa-home"></i> Update Product
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#technicalspecificationsupdate" role="tab">
                                <i class="far fa-user"></i> Technical Specifications
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#imageupdate" role="tab">
                                <i class="far fa-user"></i> Image Info
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#metaupdate" role="tab">
                                <i class="far fa-envelope"></i> Meta Info
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- Add an element to display the success message -->
                <div class="card-body p-4">
                    <div class="tab-content">
                        <div class="tab-pane active" id="productupdate" role="tabpanel">
                        @include('Admin.Product.productinfo')
                        </div>
                        <div class="tab-pane" id="technicalspecificationsupdate" role="tabpanel">
                        @include('Admin.Product.technicalspecifications')
                        </div>
                        <div class="tab-pane" id="imageupdate" role="tabpanel">
                        @include('Admin.Product.imageinfo')
                        </div>
                        <div class="tab-pane" id="metaupdate" role="tabpanel">
                        @include('Admin.Product.metainfo')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- container-fluid -->
</div>
@endsection

@section('page-css')
<link href="{{asset('assets/libs/sweetalert2/sweetalert2.min.css?v='.env('FILE_VERSION'))}}" rel="stylesheet" type="text/css" />
@endsection

@section('page-js')
<script src="{{asset('assets/libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.js')}}"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/ckeditor5-classic-free-full-feature@35.4.1/build/ckeditor.min.js"></script> -->
<script src="{{asset('assets/libs/sweetalert2/sweetalert2.min.js?v='.env('FILE_VERSION'))}}"></script>
<script>
$(function(){
    'use strict'

    $('#productFrom').submit(function() {
        $('.vertical-overlay').show(); 
    });

    $('#metaFrom').submit(function() {
        $('.vertical-overlay').show(); 
    });

    $('#imageFrom').submit(function() {
        $('.vertical-overlay').show(); 
    });

    $('#technicalspecifications').submit(function() {
        $('.vertical-overlay').show(); 
    });
    
    var ckClassicEditors = document.querySelectorAll(".ckeditor-classic");
    ckClassicEditors && ckClassicEditors.forEach(function(editorElement) {
        ClassicEditor
            .create(editorElement, {
                htmlSupport: {
                    allow: [
                        {
                            name: /.*/,
                            attributes: true,
                            classes: true,
                            styles: true
                        }
                    ]
                },
                toolbar: {
                    items: [
                            'heading','|', 'fontfamily', 'fontsize', 'fontColor', 'fontBackgroundColor',
                        '|', 'bold', 'italic', 'strikethrough', 'subscript', 'superscript', 'code','link',
                        '|', 'bulletedList', 'numberedList', 'todoList', 'outdent', 'indent',
                        '|', 'blockQuote', 'codeBlock','insertTable','mediaEmbed',
                        '|','undo', 'redo','sourceEditing'
                        
                    ]
                }
            })
            .then(function(editor) {
                editor.ui.view.editable.element.style.height = "200px"; // Set the editor height
            })
            .catch(function(error) {
                console.error(error);
            });
    });


    $(document).on('click','.remove-image', function(){
            var idStr = $(this).data('id');
            Swal.fire({
                title: "Are you sure?",
                text: "This Image is not display after this action!",
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
                    removeImage(idStr);
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

        $('.main-image-button').click(function() {
            var idStr = $(this).data('id');
            Swal.fire({
                title: "Are you sure?",
                text: "This Imaage is main display after this action!",
                icon: "warning",
                showCancelButton: !0,
                confirmButtonClass: "btn btn-primary w-xs me-2 mt-2",
                cancelButtonClass: "btn btn-danger w-xs mt-2",
                confirmButtonText: 'Yes,Is main  pls!',
                cancelButtonText: 'No, cancel!',
                buttonsStyling: !1,
                showCloseButton: !0
            }).then(function(isConfirm) {
                if(isConfirm.value){
                    isMainimage(idStr);
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

        function isMainimage(id)
    {
        $('.vertical-overlay').show();
        setTimeout(() => {
            $.ajax({
                url: "{{ route('admin.product.imagemain') }}",
                data: {id: id, _token: '{{ csrf_token() }}'},
                type: "POST",
                success: function (result) {
                    window.location.reload();
                },
                error: function(data){
                    $('.vertical-overlay').hide();
                }
            });
        }, 20);
    }


    function removeImage(id)
    {
        $('.vertical-overlay').show();
        setTimeout(() => {
            $.ajax({
                url: "{{ route('admin.image.remove') }}",
                data: {id: id, _token: '{{ csrf_token() }}'},
                type: "POST",
                success: function (result) {
                    window.location.reload();
                },
                error: function(data){
                    $('.vertical-overlay').hide();
                }
            });
        }, 20);
    }

    $(document).on('blur', '.display_order', function() {
        $('.vertical-overlay').show();

        var id = $(this).data('id');
        var display_order = $(this).val();

        $.ajax({
            url: "{{ route('admin.image.updateDisplayOrder') }}",
            data: { id: id, display_order: display_order, _token: '{{ csrf_token() }}' },
            type: "POST",
            success: function(result) {
                 $('.vertical-overlay').hide();
                 if (result.error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: result.error
                });
            } else if (result.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: result.success
                });
            }
            },
            error: function(data) {
                $('.vertical-overlay').hide();
            }
        });
    });

});


</script>
@endsection