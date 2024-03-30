@extends('Layouts.master')

@section('main-content')
<div class="home-hero position-relative overflow-hidden">
    <div class="container">
         <div class="row">
            <div class="col-md-6">
                <div class="group-hd">
                    <h2>RADIANT ELEGANCE</h2>
                    <h1>Illuminate Your Place and Embrace Ambiance with Lighting Fixtures</h1>
                    <p>Step into a realm of radiance. Our lighting designs blend elegance and functionality, illuminating spaces with timeless style and unparalleled performance.</p>
                </div>
                <div class="mt-4">
                    <a href="{{route('products')}}" class="btn btn-outline text-uppercase">Learn More &nbsp; +</a>
                </div>
            </div>      
         </div>

         <div class="home-hero-slider">
            <div class="homeHero">
                @foreach($sliderImages as $slider)
                <div>
                    <div class="home-hero-slide-card">
                        <figure class="position-absolute w-100 h-100 top-0 start-0">
                            <picture>
                                @if(!empty($slider->webp_image))
                                <source srcset="{{asset($slider->webp_image)}}" type="image/webp">
                                @endif

                                <source srcset="{{asset($slider->image)}}" type="image/jpeg">
                                <img src="{{asset($slider->image)}}" alt="{{$slider->title}}" width="200" height="200" class="position-absolute w-100 h-100 top-0 s-0 object-fit-cover">
                            </picture>                                 
                        </figure>
                    </div>   
                </div>
                @endforeach
            </div>
        </div>
    </div>        
</div>

<div class="home-what-wd">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-7">
                <div class="hwwd-card">
                    <div class="group-hd">
                        <h2>WHAT WE DO</h2>
                        <h2>Crafting Luminosity: Our Expertise in Industrial Lighting Fixtures</h2>
                        <p>Elevate your industrial setting with our high-performance lighting fixtures designed for durability and efficiency.</p>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 tailor-cnt">
                            <h4>Tailored Lighting Designs</h4>
                            {{-- <p>Lorem ipsum dolor sit amet, consectetur</p> --}}
                        </div>
                        <div class="col-lg-6 tailor-cnt">
                            <h4>Installation & Integration</h4>
                            {{-- <p>Lorem ipsum dolor sit amet, consectetur</p> --}}
                        </div>
                    </div>
                    <div class="mt-4">
                        <a href="{{route('products')}}" class="btn btn-primary sub-btn text-uppercase">Learn More &nbsp; +</a>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="wwd-image">
                    <figure class="position-absolute w-100 h-100 top-0 start-0">
                        <picture>
                            <source srcset="{{asset('front/assets/images/our-expertise-img.webp')}}" type="image/webp">
                            <source srcset="{{asset('front/assets/images/our-expertise-img.jpg')}}" type="image/jpeg"> 
                            <img src="{{asset('front/assets/images/our-expertise-img.jpg')}}" alt="what we do" width="385" height="410" class="position-absolute w-100 h-100 top-0 s-0 object-fit-cover">
                        </picture> 
                    </figure>
                </div>
                
            </div>
        </div>
    </div>
</div>

<div class="home-cat-list mt-5 pt-4">
    <ol> 
        @foreach($homeCategories as $category)
        <li>
            <a href="{{$category->link}}">{{$category->title}} <span><img src="{{asset('front/assets/images/right-arrow.svg')}}" alt="{{$category->title}}" width="20" height="20" loading="lazy"></span></a>
        </li>
        @endforeach
    </ol>        
</div>

@if($logos->count() > 0)
<div class="client-logo-section py-md-5 my-5">
    <div class="clientSlider">
        @foreach($logos as $logo)
        <div>
            <picture>
                @if(!empty($logo->webp_image))
                <source srcset="{{asset($logo->webp_image)}}" type="image/webp">
                @endif
                <source srcset="{{asset($logo->image)}}" type="image/jpeg"> 
                <img src="{{asset($logo->image)}}" alt="{{$logo->title}}" width="100" height="50" loading="lazy">
            </picture> 
        </div>
        @endforeach
    </div>
</div>
@endif

@if($galleries->count() > 0)
<div class="gallery-section px-md-4 pb-md-4">
    <div class="group-hd text-center mb-4">
        <h2>GALLERY</h2>
        <h3>Illuminate Your Imagination : <br>Our Portfolio</h3>
    </div>

    <div class="homeGallery">
        @foreach($galleries as $gallery)
        <div>
            <a href="{{asset($gallery->image)}}">
                <picture>
                    @if(!empty($gallery->webp_image))
                    <source srcset="{{asset($gallery->webp_image)}}" type="image/webp">
                    @endif
                    <source srcset="{{asset($gallery->image)}}" type="image/jpeg"> 
                    <img src="{{asset($gallery->image)}}" alt="{{$gallery->title}}" width="385" height="410" loading="lazy">
                </picture> 
            </a>
        </div>
        @endforeach
    </div>
</div>
@endif

<div class="home-contact py-5 my-md-4" id="getInTouch">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="group-hd mb-4">
                    <h2>STAY CONNECTED</h2>
                    <h4>Get A Quote</h4>
                    <p>Please fill out the following details and we will get back to you as soon as possible.</p>
                </div>

                <div class="homecnt-form">

                    {{ Form::open(['route' => 'get-a-quote', 'id' => 'getQuoteFrom', 'data-parsley-validate', 'autocomplete' => 'off']) }}
                        {{-- @error('g-recaptcha-response')
                            <div class="form-group full-width">
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
                            {{Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Your Name', 'required'])}}
                        </div>
                        <div class="form-group">
                            {{Form::email('email', '', ['class' => 'form-control', 'placeholder' => 'Email', 'required'])}}
                        </div>
                        <div class="form-group full-width">
                            {{Form::text('subject', '', ['class' => 'form-control', 'placeholder' => 'Subject', 'required'])}}
                        </div>
                        <div class="form-group full-width">
                            {{Form::textarea('message', '', ['class' => 'form-control', 'placeholder' => 'Message', 'required'])}}
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

            <div class="col-md-6">
                <div class="locatin-card">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2244.0398896246706!2d72.83072297067253!3d18.930942753280206!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be7d1354b8b0f19%3A0xf2f233833a851175!2sGundecha%20Chambers!5e0!3m2!1sen!2sin!4v1707320945078!5m2!1sen!2sin" width="100" height="450" style="border:0; width:100%;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" class="d-flex"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('page-css')
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.css">
<link rel="stylesheet" type="text/css" href="https://mreq.github.io/slick-lightbox/dist/slick-lightbox.css">
<link rel="stylesheet" type="text/css" href="https://mreq.github.io/slick-lightbox/gh-pages/bower_components/slick-carousel/slick/slick-theme.css">  
{{-- <link href="{{asset('assets/libs/jsvectormap/css/jsvectormap.min.css?v='.env('FILE_VERSION'))}}" rel="stylesheet" type="text/css" /> --}}
@endsection

@section('page-js')
<script src="https://www.google.com/recaptcha/api.js"></script>
<script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script src="https://mreq.github.io/slick-lightbox/dist/slick-lightbox.js"></script>
{{-- <script src="{{asset('assets/libs/apexcharts/apexcharts.min.js?v='.env('FILE_VERSION'))}}"></script> --}}

<script>
    $(function(){
        'use strict'

        $('#getQuoteFrom').submit(function() {
            $('.page-loader').show(); 
        });
        
        $('.homeHero').slick({
            dots: false,
            infinite: true,
            arrows: false,
            autoplay: true,
            speed: 300,
            slidesToShow: 3,
            slidesToScroll: 1,
            responsive: [         
            {
                breakpoint: 960,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
                },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1.2,
                    slidesToScroll: 1
                }
            }
            ]
        });

        $('.clientSlider').slick({
            dots: false,
            infinite: true,
            arrows: false,
            autoplay: true,
            speed: 300,
            slidesToShow: 7,
            slidesToScroll: 1,
            responsive: [            
                {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 5,
                    slidesToScroll: 1
                }
                },
                {
                breakpoint: 480,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
                }
            ]
        });

        $('.homeGallery').slick({
            dots: false,
            infinite: true,
            arrows: false,
            autoplay: true,
            speed: 300,
            slidesToShow: 4,
            slidesToScroll: 1,
            responsive: [         
                
                {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1.1,
                    slidesToScroll: 1
                }
                }
            ]
        });

        $('.homeGallery').slickLightbox({
            itemSelector        : 'a',
            navigateByKeyboard  : true
        });

    });
</script>
@endsection