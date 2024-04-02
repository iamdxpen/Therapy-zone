@extends('Layouts.master')

@section('main-content')

<div class="content-page py-5">
    <div class="container">
        <h1>{{$pageObj->title}}</h1>
        <div class="contact-page">
            <div class="company-location">
                {!! $pageObj->content !!}
            </div>

            <div class="contant-page-form homecnt-form">
                <div class="group-hd mb-4">
                    <h2>STAY CONNECTED</h2>
                    <h4>Get in Touch</h4>
                </div>
    
                {{ Form::open(['route' => 'submit-contact-us', 'id' => 'contactUsFrom', 'data-parsley-validate', 'autocomplete' => 'off']) }}
                
                    {{-- @error('g-recaptcha-response')
                        <div class="form-group full-width mt-3">
                            <div class="alert alert-danger">{{ $message }}</div>
                        </div>
                    @enderror --}}

                    @foreach ($errors->all() as $error)
                    <div class="form-group full-width">
                        <div class="alert alert-danger">{!! $errors->first() !!}</div>
                    </div>
                    @endforeach

                    @if(Session::has('error'))
                    <div class="form-group full-width">
                        <div class="alert alert-danger">{{ Session::get('error') }}</div>
                    @endif

                    @if(Session::has('success'))
                    <div class="form-group full-width">
                        <div class="alert alert-success">{{ Session::get('success') }}</div>
                    </div>
                    @endif
                
                    <div class="form-group">
                        {{Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Name', 'required'])}}
                    </div>
                    <div  class="form-group">
                        {{Form::text('organization', '', ['class' => 'form-control', 'placeholder' => 'Organization'])}}
                    </div>
                    <div  class="form-group full-width">
                        {{Form::text('address', '', ['class' => 'form-control', 'placeholder' => 'Address', 'required'])}}
                    </div>
                    <div  class="form-group">
                        {{Form::text('city', '', ['class' => 'form-control', 'placeholder' => 'City', 'required'])}}
                    </div>
                    <div  class="form-group">
                        {{Form::select('country', $countries, '',['class' => 'form-control form-select', 'required'])}}
                    </div>
                    <div  class="form-group">
                        {{Form::text('phone', '', ['class' => 'form-control', 'placeholder' => 'Phone', 'required'])}}
                    </div>
                    <div class="form-group">
                        {{Form::email('email', '', ['class' => 'form-control', 'placeholder' => 'Email', 'required'])}}
                    </div>
    
                    <div class="form-group full-width">
                        <h5 class="mb-0 mt-3">YOUR QUESTION / COMMENT </h5>
                    </div>
                    <div  class="form-group">
                        {{Form::select('subject', salesEnquiry(), '',['class' => 'form-control form-select', 'placeholder' => 'Select Enquiry Type', 'required'])}}
                    </div>
                    <div  class="form-group">
                        {{Form::select('product', enquiryProduct(), '',['class' => 'form-control form-select', 'placeholder' => 'Select Product', 'required'])}}
                    </div>

                    <div  class="form-group full-width">
                        {{Form::textarea('comments', '', ['class' => 'form-control', 'placeholder' => 'Comments*', 'required'])}}
                    </div>

                    <div class="form-group full-width">
                        {!! app('captcha')->display() !!}
                    </div>

                    <div class="form-group full-width">
                        <input type="submit" value="SUBMIT" class="btn btn-primary sub-btn w-100">
                    </div>
                {{ Form::close() }}
            </div>

        </div>
    </div>
</div>
@endsection

@section('page-css')
@endsection

@section('page-js')
<script src="https://www.google.com/recaptcha/api.js"></script>
<script>
    $(function(){
        'use strict'

        $('#contactUsFrom').submit(function() {
            $('.page-loader').show(); 
        });
    });
</script>
@endsection