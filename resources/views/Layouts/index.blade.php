<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://unpkg.com/@webpixels/css@1.2.6/dist/index.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper@11.1.1/swiper-bundle.min.css" />
    <link href="{{ asset('frontend/css/app.css') }}" rel="stylesheet">
    <title>Therapy zone</title>
</head>

<body>
    <div id="home" class="inter">
        @include('Layouts.header')
        <main>
            @yield('content')
        </main>
        @include('Layouts.footer')
        <!-- <div class="wh-button">
            <div class="go-top-inner hstack justify-content-center rounded-circle">
                
            </div>
        </div> -->
        <div class="go-top">
            <div class="go-top-inner hstack justify-content-center rounded-circle">
                <i class="bi bi-chevron-up font-bolder lh-none text-lg"></i>
            </div>
        </div>
        <div class="wh-button">
            <a class="btn p-0 btn-success w-12 h-12 rounded-circle d-flex align-items-center justify-content-center" target="_blank" href="https://api.whatsapp.com/send?phone=7688005555" role="button"><i class="bi bi-whatsapp font-bolder lh-none text-lg"></i></a>
        </div>
    </div>
    <script src="{{ asset('frontend/js/jquery-1.11.0.min.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap.bundle.min.js') }}"></script>
    <!-- <script src="{{asset('plugins/toastr/toastr.min.js')}}"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script> -->
    <script src="https://unpkg.com/swiper@11.1.1/swiper-bundle.min.js"></script>
    <script src="{{ asset('frontend/js/custom.js') }}"></script>
    <!-- slider -->
    <script>
    // var swiper = new Swiper(".testimonial-slider", {
    //     slidesPerView: 1,
    //     spaceBetween: 24,
    //     loop: true,
    //     autoplay: {
    //         delay: 2000,
    //         disableOnInteraction: false
    //     },
    //     pagination: {
    //         el: '.swiper-pagination',
    //         clickable: true,
    //     },
    //     navigation: {
    //         nextEl: '.testimonial-slider-next',
    //         prevEl: '.testimonial-slider-prev',
    //     },
    //     breakpoints: {
    //         // when window width is >= 640px
    //         768: {
    //             slidesPerView: 2,
    //             spaceBetween: 20,
    //         },
    //         // when window width is >= 768px
    //         992: {
    //             slidesPerView: 3,
    //             spaceBetween: 30,
    //         },
    //     }
    // });
    </script>
</body>

</html>