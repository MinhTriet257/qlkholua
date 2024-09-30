
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title> {{ $title }} </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    {{-- <!-- Plugin css -->
    <link href="assets/vendor/daterangepicker/daterangepicker.css" rel="stylesheet" type="text/css">
    <link href="assets/vendor/jsvectormap/css/jsvectormap.min.css" rel="stylesheet" type="text/css">

    <!-- Theme Config Js -->
    <script src="assets/js/hyper-config.js"></script> --}}

    <!-- App css -->
    <link href="{{ asset('css/app-saas.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />

    <!-- Icons css -->
    {{-- <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" /> 
    sửa dòng trên như dòng dưới để chạy đc 
    --}} 
    <link href="{{ asset('css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet" />
    @stack('css')   {{-- datatable --}}
</head>

<body>
    @include('layout.sidebar')
    <!-- Begin page -->
    <div class="wrapper">
        @include('layout.header')
        <div class="content-page">
            <div class="content">
                <!-- Start Content-->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">                             
                                <h4 class="page-title"> {{ $title }} </h4>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @if ($errors->any())
                            <div class="col-12">
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif
                        @if (session()->has('success'))
                            <div class="col-12">
                                <div class="alert alert-success">
                                    
                                    {{ session()->get('success') }}
                                </div>
                            </div>
                        @endif

                        <div class="col-12">
                            @yield('content')
                        </div>
                        <!-- container -->
                    </div>
            </div>
            <!-- content -->
        @include('layout.footer')
        </div>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->
    </div>
    <!-- END wrapper -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
   
   
    <!-- Vendor js -->
    <script src="{{ asset('js/vendor.min.js')}}"></script>
   
    <!-- App js -->
    <script src="{{ asset('js/app.min.js')}}"></script>

    @stack('js')
    

    {{-- <!-- Daterangepicker js -->
    <script src="assets/vendor/daterangepicker/moment.min.js"></script>
    <script src="assets/vendor/daterangepicker/daterangepicker.js"></script>

    <!-- Charts js -->
    <script src="assets/vendor/chart.js/chart.min.js"></script>
    <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>

    <!-- Vector Map js -->
    <script src="assets/vendor/jsvectormap/js/jsvectormap.min.js"></script>
    <script src="assets/vendor/jsvectormap/maps/world-merc.js"></script>
    <script src="assets/vendor/jsvectormap/maps/world.js"></script>
    <!-- Analytics Dashboard App js -->
    <script src="assets/js/pages/demo.dashboard-analytics.js"></script> 
    --}}

</body>

</html>