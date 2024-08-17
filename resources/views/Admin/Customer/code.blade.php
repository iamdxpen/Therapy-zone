<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">

<head>

    <meta charset="utf-8" />
    <title>Create New Password | Velzon - Admin & Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">

    <!-- Layout config Js -->
    <script src="{{asset('assets/js/layout.js')}}"></script>
    <!-- Bootstrap Css -->
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{asset('assets/css/app.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="{{asset('assets/css/custom.min.css')}}" rel="stylesheet" type="text/css" />

</head>

<body>

    <!-- auth-page wrapper -->
    <div class="auth-page-wrapper auth-bg-cover py-5 d-flex justify-content-center align-items-center min-vh-100">
        <div class="bg-overlay"></div>
        <!-- auth-page content -->
        <div class="auth-page-content overflow-hidden pt-lg-5">
            <div class="container">
            <div class="row">
    <div class="col-lg-12">
        <div class="card overflow-hidden">
            <div class="row justify-content-center g-0">
                <div class="col-lg-6">
                    <div class="p-lg-5 p-4 auth-one-bg h-100 d-flex justify-content-center align-items-center">
                        <img src="{{asset('frontend/images/logo/logo.svg')}}" alt="" height="18">
                    </div>
                </div>
                <!-- end col -->
                <div class="col-lg-6">
                    @if(Session::has('error'))
                                        <div class="alert alert-danger" role="alert">{{ Session::get('error') }}</div>
                                        @endif

                                        @if(Session::has('success'))
                                        <div class="alert alert-success" role="alert">{{ Session::get('success') }}</div>
                                        @endif

                                        @foreach ($errors->all() as $error)
                                        <div class="alert alert-danger" role="alert">{!! $error !!}</div>
                                        @endforeach
                    <div class="p-lg-5 p-4">
                        <h5 class="text-primary">Check CustomerPackage Code</h5>
                        <div class="p-2">
                            {{ Form::open(['route' => 'code.store', 'id' => 'customerFrom', 'data-parsley-validate', 'files' => true, 'autocomplete' => 'off']) }}
                                <div class="mb-3">
                                    <label class="form-label">Select Spa</label>
                                    <div class="position-relative auth-pass-inputgroup">
                                        <?php
                                            $spa = App\Models\Spa::where('status', 'Active')->get()->pluck('title', 'id');
                                        ?>
                                        {{Form::select('spa', $spa, '',['class' => 'form-control pe-5', 'placeholder' => '-please select-','required'])}}
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Select Customer</label>
                                    <div class="position-relative auth-pass-inputgroup mb-3">
                                    <?php
                                            $customer = App\Models\Customer::get()->pluck('name', 'id');
                                        ?>
                                        {{Form::select('customer', $customer, '',['class' => 'form-control pe-5', 'placeholder' => '-please select-','required'])}}
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Enter Code</label>
                                    <div class="position-relative auth-pass-inputgroup mb-3">
                                        {{Form::text('code', '', ['class' => 'form-control pe-5', 'placeholder' => 'Enter code', 'id' => 'code', 'required'])}}
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <button class="btn btn-success w-100" type="submit">Check</button>
                                </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end card -->
    </div>
    <!-- end col -->
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
                            <p class="mb-0">&copy;
                                <script>document.write(new Date().getFullYear())</script> <i class="mdi mdi-heart text-danger"></i>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end Footer -->
    </div>
    <!-- end auth-page-wrapper -->

    <!-- JAVASCRIPT -->
    <script src="{{asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/libs/simplebar/simplebar.min.js')}}"></script>
    <script src="{{asset('assets/libs/node-waves/waves.min.js')}}"></script>
    <script src="{{asset('assets/libs/feather-icons/feather.min.js')}}"></script>
    <script src="{{asset('assets/js/pages/plugins/lord-icon-2.1.0.js')}}"></script>
    <script src="{{asset('assets/js/plugins.js')}}"></script>

    <!-- password-addon init -->
    <script src="{{asset('assets/js/pages/passowrd-create.init.js')}}"></script>
</body>

</html>