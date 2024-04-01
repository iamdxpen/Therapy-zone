<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link href="https://unpkg.com/@webpixels/css@1.2.6/dist/index.css" rel="stylesheet"> -->
    <link href="{{ asset('frontend/css/app.min.css?ver=')}}{{env('CDN_VERSION') }}" rel="stylesheet">
    <title>Techvoot Solutions</title>
</head>
<body>
    <div id="home" class="inter">
        @include('Layouts.header')
        <main>
            @yield('content')
        </main>
        @include('Layouts.footer')
    </div>
    <script src="{{ asset('frontend/js/jquery-1.11.0.min.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('frontend/library/slick/slick.min.js') }}"></script>
    <script src="{{ asset('frontend/library/vendor/aos/aos.js') }}"></script>
    <script src="{{asset('plugins/toastr/toastr.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="{{ asset('frontend/js/custom.js?ver=')}}{{env('CDN_VERSION') }}"></script>
</body>

</html>
