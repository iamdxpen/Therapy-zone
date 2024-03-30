<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('frontend/css/app.min.css?ver=')}}{{env('CDN_VERSION') }}" rel="stylesheet">
    <title>Techvoot Solutions</title>
    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet"> 
</head>
<body>
    <div id="home" class="inter">
        @include('Layouts.header')
        <main>
            @yield('content')
        </main>
        @include('Layouts.footer')
    </div>
    <!-- <script src="../"></script> -->
    <script src="{{ asset('frontend/js/custom.js') }}"></script>
</body>

</html>
