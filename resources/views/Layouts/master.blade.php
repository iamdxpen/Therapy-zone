@include('Layouts.main')
<head>
    @include("Layouts.title-meta")
    @yield('page-css')
    @include("Layouts.head-css")
</head>
<body>
    <div class="page-loader" style="display: none">
        <div class="triple-spinner"></div>
    </div>

    @include('Layouts.header')
    @yield('main-content')
    @include('Layouts.footer')

    @include("Layouts.vendor-scripts")
    @yield('page-js')
</body>
</html>