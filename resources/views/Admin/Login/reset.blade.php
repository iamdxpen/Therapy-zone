@section('page-title', 'Reset Password')
@include('Admin.Layouts.main')
    <head>
        @include("Admin.Layouts.title-meta")
        @include("Admin.Layouts.head-css")
    </head>
    <body>
        <div class="auth-page-wrapper">
            <!-- auth page bg -->
            <div class="auth-one-bg-position auth-one-bg" id="auth-particles">
                <div class="bg-overlay"></div>

                <div class="shape">
                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1440 120">
                        <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
                    </svg>
                </div>
            </div>

            <!-- auth page content -->
            <div class="auth-page-content">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="text-center mt-sm-5 mb-4 text-white-50">
                                <div>
                                    <a href="{{route('admin.login')}}" class="d-inline-block auth-logo">
                                        <img src="{{get_image_url(get_site_logo())}}" alt="" height="60">
                                    </a>
                                </div>
                                {{-- <p class="mt-3 fs-15 fw-medium">Premium Admin & Dashboard Template</p> --}}
                            </div>
                        </div>
                    </div>
                    <!-- end row -->

                    <div class="row justify-content-center">
                        <div class="col-md-8 col-lg-6 col-xl-5">
                            <div class="card mt-4">

                                <div class="card-body p-4">
                                    <div class="text-center mt-2">
                                        <h5 class="text-primary">Create new password</h5>
                                        <p class="text-muted">Your new password must be different from previous used password.</p>
                                    </div>

                                    @if(Session::has('error'))
                                    <div class="alert alert-borderless alert-danger mb-2 mx-2" role="alert">{{ Session::get('error') }}</div>
                                    @endif
            
                                    @if(Session::has('success'))
                                    <div class="alert alert-borderless alert-success mb-2 mx-2" role="alert">{{ Session::get('success') }}</div>
                                    @endif

                                    @foreach ($errors->all() as $error)
                                    <div class="alert alert-borderless alert-danger mb-2 mx-2" role="alert">{!! $errors->first() !!}</div>
                                    @endforeach

                                    <div class="p-2">

                                        {{ Form::open(['route' => 'admin.password.update', 'id' => 'loginFrom', 'data-parsley-validate', 'autocomplete' => 'off']) }}
                                            <input type="hidden" name="token" value="{{ $token }}">
                                            <input type="hidden" name="email" value="{{$email}}" />

                                            <div class="mb-3">
                                                <label for="password" class="form-label">Password</label>
                                                {{Form::password('password',['class' => 'form-control', 'placeholder' => 'Enter password', 'id' => 'password', 'required'])}}
                                            </div>

                                            <div class="mb-3">
                                                <label for="password_confirmation" class="form-label">Confirm Password</label>
                                                {{Form::password('password_confirmation',['class' => 'form-control', 'placeholder' => 'Enter confirm password', 'id' => 'password_confirmation', 'required', 'data-parsley-equalto' => "#password", 'data-parsley-equalto-message' => "Confirm password should be the same as new password"])}}
                                            </div>

                                            <div class="mt-4">
                                                <button class="btn btn-success w-100" type="submit">Reset Password</button>
                                            </div>
                                        {{ Form::close() }}
                                    </div>
                                </div>
                                <!-- end card body -->
                            </div>
                            <!-- end card -->

                            <div class="mt-4 text-center">
                                <p class="mb-0">Wait, I remember my password... <a href="{{route('admin.login')}}" class="fw-semibold text-primary text-decoration-underline"> Click here </a> </p>
                            </div>

                        </div>
                    </div>
                    <!-- end row -->
                </div>
                <!-- end container -->
            </div>
            <!-- end auth page content -->

            <!-- footer -->
            <footer class="footer">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="text-center">
                                <p class="mb-0 text-muted">
                                    {!! get_reserved_right() !!}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- end Footer -->
        </div>
        <!-- end auth-page-wrapper -->

        <script src="{{asset('assets/libs/jquery/jquery.min.js?v='.env('FILE_VERSION'))}}"></script>
        <script src="{{asset('assets/libs/parsleyjs/parsley.min.js?v='.env('FILE_VERSION'))}}"></script>

        <!-- particles js -->
        <script src="{{asset('assets/libs/particles.js/particles.js?v='.env('FILE_VERSION'))}}"></script>
        <!-- particles app js -->
        <script src="{{asset('assets/js/pages/particles.app.js?v='.env('FILE_VERSION'))}}"></script>
        <!-- password-addon init -->
        <script src="{{asset('assets/js/pages/password-addon.init.js?v='.env('FILE_VERSION'))}}"></script>
    </body>
</html>