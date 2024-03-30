@include('Admin.Layouts.main')
<head>
    @include("Admin.Layouts.title-meta")
    @yield('page-css')
    @include("Admin.Layouts.head-css")
</head>
<body>
    <div id="layout-wrapper">
        @include('Admin.Layouts.header')
        @include('Admin.Layouts.sidebar')
        <div class="vertical-overlay">
            <div class="d-flex align-items-center justify-content-center h-100">
                <div class="spinner-border text-warning" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
        </div>
        <div class="main-content">
            @yield('main-content')
            @include('Admin.Layouts.footer')
        </div>
        <!--start back-to-top-->
        <button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
            <i class="ri-arrow-up-line"></i>
        </button>
        <!--end back-to-top-->
    </div>

    @include("Admin.Layouts.vendor-scripts")
    @yield('page-js')
</body>
</html>