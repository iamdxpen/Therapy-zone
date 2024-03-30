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
                            <li class="breadcrumb-item active">Add Product</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        {{ Form::open(['route' => 'admin.product.store', 'id' => 'productFrom', 'data-parsley-validate', 'files' => true, 'autocomplete' => 'off']) }}
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Add New Product</h4>
                    </div>
                    <div class="card-body">
                        @if(Session::has('error'))
                        <div class="alert alert-danger mb-2" enquiry="alert">{{ Session::get('error') }}</div>
                        @endif

                        @if(Session::has('success'))
                        <div class="alert alert-success mb-2" enquiry="alert">{{ Session::get('success') }}</div>
                        @endif

                        @foreach ($errors->all() as $error)
                        <div class="alert alert-danger mb-2" enquiry="alert">{!! $errors->first() !!}</div>
                        @endforeach


                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                                    {{Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Enter Name', 'id' => 'name', 'required'])}}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="slug" class="form-label">Slug <span class="text-danger">*</span></label>
                                    {{Form::text('slug', '', ['class' => 'form-control', 'placeholder' => 'Enter Slug', 'id' => 'slug', 'required', 'data-parsley-slug'=>"true", 'data-parsley-slug-message'=>"Please provide a unique slug"])}}
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="mb-3">
                                <label for="image" class="form-label">Image<span class="text-danger">*</span> </label>
                                    {{Form::file('image', ['class' => 'form-control', 'placeholder' => 'Select image', 'id' => 'image','required'])}}
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                    @php($status = array('Active' => 'Active', 'Inactive' => 'Inactive'))
                                    {{Form::select('status', $status, '',['class' => 'form-select', 'required'])}}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <div class="mb-3">
                                    <label for="product_type" class="form-label">Product Type <span class="text-danger">*</span></label>
                                    {{Form::select('product_type', $product_type, '',['class' => 'form-select','placeholder' => 'Please Select','required'])}}
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="mb-3">
                                    <label for="product_used_in" class="form-label">Product Used In <span class="text-danger">*</span></label>
                                    {{Form::select('product_used_in', $product_use_in, '',['class' => 'form-select','placeholder' => 'Please Select','required'])}}
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="mb-3">
                                    <label for="product_use_type" class="form-label">Product Used Type <span class="text-danger">*</span></label>
                                    {{Form::select('product_use_type', $product_use_type, '',['class' => 'form-select','placeholder' => 'Please Select','required'])}}
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="mb-3">
                                    <label for="product_usage" class="form-label">Product Usage <span class="text-danger">*</span></label>
                                    {{Form::select('product_usage', $product_usage, '',['class' => 'form-select','placeholder' => 'Please Select','required'])}}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <div class="mb-3">
                                    <label for="device_code" class="form-label">Device Code <span class="text-danger">*</span></label>
                                    {{Form::text('device_code', '', ['class' => 'form-control', 'placeholder' => 'Enter Device Code', 'id' => 'device_code', 'required'])}}
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-3">
                                    <label for="colour" class="form-label">Colour <span class="text-danger">*</span></label>
                                    {{Form::text('colour', '', ['class' => 'form-control', 'placeholder' => 'Enter Colour', 'id' => 'colour', 'required'])}}
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-3">
                                    <label for="wattage" class="form-label">Wattage <span class="text-danger">*</span></label>
                                    {{Form::text('wattage', '', ['class' => 'form-control', 'placeholder' => 'Enter Wattage', 'id' => 'wattage', 'required'])}}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="short_description" class="form-label">Short Description</label>
                                    {{Form::textarea('short_description', '', ['class' => 'form-control', 'placeholder' => 'Enter Short Description', 'id' => 'short_description','rows'=> 3])}}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    {{Form::textarea('description','',['class' => 'form-control ckeditor-classic','placeholder' => 'Enter Description', 'id' => 'description'])}}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                <label for="meta_title" class="form-label">Meta Title</label>
                                    {{Form::textarea('meta_title','', ['class' => 'form-control', 'placeholder' => 'Enter Meta Title', 'id' => 'meta_title','rows'=> 3])}}
                                </div>
                            </div>    
                            <div class="col-6">
                                <div class="mb-3">
                                <label for="meta_keyword" class="form-label">Meta Keyword</label>
                                    {{Form::textarea('meta_keyword','', ['class' => 'form-control', 'placeholder' => 'Enter Meta keyword', 'id' => 'meta_title','rows'=> 3])}}
                                </div>
                            </div>
                        </div>    
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="meta_description" class="form-label">Meta Description</label>
                                    {{Form::textarea('meta_description','', ['class' => 'form-control', 'placeholder' => 'Enter Meta Description', 'id' => 'meta_title','rows'=> 3])}}
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
<script src="{{asset('assets/libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.js')}}"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/ckeditor5-classic-free-full-feature@35.4.1/build/ckeditor.min.js"></script> -->



<script>
     $(function(){
      'use strict'

        $('#enquiryFrom').submit(function() {
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
                editor.ui.view.editable.element.style.height = "200px"; 
            })
            .catch(function(error) {
                console.error(error);
            });
        });

    function generateSlugFromName() {
        const name = $('#name').val();
        const slug = name.toLowerCase().replace(/[^a-z0-9]+/g, '-');
        $('#slug').val(slug);
    }

    $('#name').on('keyup', function() {
        generateSlugFromName();
    });

    $(document).ready(function() {
        generateSlugFromName();
    });

    window.ParsleyValidator.addValidator('slug', 
            function (value) {
                var valid = false;
                $.ajax({
                    url: '{{route("admin.product.slug")}}',
                    data: {
                        slug: value,
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