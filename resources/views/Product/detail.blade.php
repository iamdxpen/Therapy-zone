@extends('Layouts.master')

@section('main-content')
<div class="product-info-top py-3 py-lg-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-7">
                <div class="d-lg-none wap-heading">{{$product->name}}</div>
                <div class="product-slider">
                    <div class="slider slider-nav">
                        @foreach($product->images as $images)
                            @if($images->is_main != 1)
                            <div>
                                <div class="thumbnail-image">
                                    <img src="{{get_image_url($images->image)}}" alt="{{$product->name}}" width="100" height="100">
                                </div>                                
                            </div>
                            @endif
                        @endforeach
                    </div>

                    <div class="slider slider-for">
                        @foreach($product->images as $images)
                            @if($images->is_main != 1)
                            <div>
                                <div class="slider-banner-image">
                                    <img src="{{get_image_url($images->image)}}" alt="{{$product->name}}" width="100" height="100">
                                </div>                                
                            </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="pt-right d-flex flex-column align-items-start">
                    <h1 class="mb-0 d-none d-lg-block">{{$product->name}}</h1>

                    @if(!empty($product->device_code))
                        <div class="device-code">Device Code:  <strong>{{$product->device_code}}</strong></div>
                    @endif

                    @if(!empty($product->colour) || !empty($product->wattage))
                    <div class="product-cw-card d-grid w-100">
                        @if(!empty($product->colour))
                        <div class="pcw-inner d-flex align-items-center">
                            <figure><img src="{{asset('front/assets/images/color.svg')}}" alt="colour" width="10" height="10"></figure>
                            <div>
                                <span>Colour</span>
                                <p>{{$product->colour}}</p>
                            </div>
                        </div>
                        @endif

                        @if(!empty($product->wattage))
                        <div class="pcw-inner d-flex align-items-center">
                            <figure><img src="{{asset('front/assets/images/walt.svg')}}" alt="Wattage" width="10" height="10"></figure>
                            <div>
                                <span>Wattage</span>
                                <p>{{$product->wattage}}</p>
                            </div>
                        </div>
                        @endif
                    </div>
                    @endif

                    @if(!empty($product->short_description))
                    <div class="short-desc">
                        {{$product->short_description}}
                    </div>
                    @endif

                    @foreach ($errors->all() as $error)
                    <div class="form-group w-100">
                        <div class="alert alert-danger">{!! $errors->first() !!}</div>
                    </div>
                    @endforeach

                    @if(Session::has('error'))
                    <div class="form-group w-100">
                        <div class="alert alert-danger">{{ Session::get('error') }}</div>
                    @endif

                    @if(Session::has('success'))
                    <div class="form-group w-100">
                        <div class="alert alert-success">{{ Session::get('success') }}</div>
                    </div>
                    @endif

                    <div class="w-100">
                        <a href="#" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#SendEnquiry">Send Enquiry</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@if($product->technicalSpecifications->count() > 0)
<div class="product-info py-3 py-lg-5">
    <div class="container">
        <div class="pi-card bg-white p-4 rounded-3">
            <div class="pi-header">
                <h2>Technical Features</h2>
            </div>

            <div class="pi-body">
                @foreach($product->technicalSpecifications as $technicalSpecifications)
                @if(!empty($technicalSpecifications->technicalSpecification))
                <div class="pibody-col">
                    <label>{{$technicalSpecifications->technicalSpecification->name}}</label>
                    <p>{{$technicalSpecifications->value}}</p>
                </div>
                @endif
                @endforeach
            </div>

        </div>
    </div>
</div>
@endif

<div class="modal fade" id="SendEnquiry" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content rounded-0 border-0">
        <div class="modal-header border-0 pb-0">
          <h3 class="modal-title fs-5" id="exampleModalLabel">Send Enquiry</h3>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z"/>
              </svg>
          </button>
        </div>
        <div class="modal-body">
            <div class="homecnt-form">
                {{ Form::open(['route' => 'send-enquiry', 'id' => 'enquiryFrom', 'data-parsley-validate', 'autocomplete' => 'off']) }}
                    <div class="form-group">
                        {{Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Your Name', 'required'])}}
                    </div>
                    <div class="form-group">
                        {{Form::email('email', '', ['class' => 'form-control', 'placeholder' => 'Email', 'required'])}}
                    </div>
                    {{-- <div class="form-group full-width">
                        <input type="text" value="" class="form-control" placeholder="Subject">
                    </div> --}}
                    <div class="form-group full-width">
                        {{Form::textarea('message', '', ['class' => 'form-control', 'placeholder' => 'Message', 'required'])}}
                    </div>
                    <div class="form-group full-width">
                        {{Form::hidden('product', $product->name)}}
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
</div>

@endsection

@section('page-css')
{{-- <link href="{{asset('assets/libs/jsvectormap/css/jsvectormap.min.css?v='.env('FILE_VERSION'))}}" rel="stylesheet" type="text/css" /> --}}
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.css">
@endsection

@section('page-js')
<script src="https://www.google.com/recaptcha/api.js"></script>
{{-- <script src="{{asset('assets/libs/apexcharts/apexcharts.min.js?v='.env('FILE_VERSION'))}}"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script>
    $(function(){
        'use strict'

        $('#enquiryFrom').submit(function() {
            $('#SendEnquiry').modal('hide');
            $('.page-loader').show(); 
        });
        
        $('.slider-for').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            fade: true,
            asNavFor: '.slider-nav',
            fade: false,
        });

        $('.slider-nav').slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            vertical:true,
            asNavFor: '.slider-for',
            dots: false,
            arrows: false,
            focusOnSelect: true,
            verticalSwiping:true,
            responsive: [
            {
                breakpoint: 992,
                settings: {
                vertical: false,
                }
            },    
            ]
        });
    });
</script>
@endsection