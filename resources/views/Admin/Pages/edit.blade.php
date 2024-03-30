@extends('Admin.Layouts.master')
@section('page-title', 'Pages Management')

@section('main-content')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Pages Management</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboards</a></li>
                            <li class="breadcrumb-item"><a href="{{route('admin.pages')}}">Pages Management</a></li>
                            <li class="breadcrumb-item active">Update Pages</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        {{ Form::open(['route' => ['admin.pages.update', ['id' => $pages->id]], 'id' => 'pagesFrom', 'data-parsley-validate', 'files' => true, 'autocomplete' => 'off']) }}
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Update pages</h4>
                    </div>
                    <div class="card-body">
                        @if(Session::has('error'))
                        <div class="alert alert-danger mb-2" pages="alert">{{ Session::get('error') }}</div>
                        @endif

                        @if(Session::has('success'))
                        <div class="alert alert-success mb-2" pages="alert">{{ Session::get('success') }}</div>
                        @endif

                        @foreach ($errors->all() as $error)
                        <div class="alert alert-danger mb-2" pages="alert">{!! $errors->first() !!}</div>
                        @endforeach

                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                <label for="title" class="form-label">Title<span class="text-danger">*</span></label>
                                    {{Form::text('title',$pages->title, ['class' => 'form-control', 'placeholder' => 'Enter Title', 'id' => 'title','required'])}}
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                    @php($status = array('Active' => 'Active', 'Inactive' => 'Inactive'))
                                    {{Form::select('status', $status, $pages->status,['class' => 'form-select','required'])}}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="content" class="form-label">Content</label>
                                    {{Form::textarea('content',$pages->content,['class' => 'form-control ckeditor-classic','placeholder' => 'Enter Content', 'id' => 'content'])}}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                <label for="meta_title" class="form-label">Meta Title</label>
                                    {{Form::textarea('meta_title',$pages->meta_title, ['class' => 'form-control', 'placeholder' => 'Enter Meta Title', 'id' => 'meta_title','rows'=> 3])}}
                                </div>
                            </div>    
                            <div class="col-6">
                                <div class="mb-3">
                                <label for="meta_keyword" class="form-label">Meta Keyword</label>
                                    {{Form::textarea('meta_keyword',$pages->meta_keyword, ['class' => 'form-control', 'placeholder' => 'Enter Meta keyword', 'id' => 'meta_title','rows'=> 3])}}
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="meta_description" class="form-label">Meta Description</label>
                                    {{Form::textarea('meta_description',$pages->meta_description, ['class' => 'form-control', 'placeholder' => 'Enter Meta Description', 'id' => 'meta_title','rows'=> 3])}}
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

        $('#pagesFrom').submit(function() {
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

    });
</script>
@endsection