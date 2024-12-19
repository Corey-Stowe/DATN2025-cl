<!doctype html>
<html lang="en">

{{-- {{ dd(Auth::user()) }} --}}
<!-- Mirrored from themesdesign.in/webadmin/layouts/layouts-horizontal.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 15 Nov 2024 00:53:59 GMT -->
<head>

        <meta charset="utf-8" />
        <title>Ví tiền điện tử</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesdesign" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- plugin css -->
       <link href="{{  Module::asset('wallet:libs/jsvectormap/css/jsvectormap.min.css')    }}" rel="stylesheet" type="text/css" />


        <!-- Bootstrap Css -->
        <link href="{{ Module::asset('wallet:css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{ Module::asset('wallet:css/icons.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ Module::asset('wallet:css/app.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{ Module::asset('wallet:css/bootstrap.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />

    </head>
    <body data-layout="horizontal">

        <!-- Begin page -->
        <div id="layout-wrapper">

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">
                <div class="page-content">
                   <div class="container-fluid">

                        @yield('content')
                    </div>

                </div>

            </div>

        </div>
        <script src="{{ Module::asset('wallet:libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ Module::asset('wallet:libs/metismenujs/metismenujs.min.js') }}"></script>
        <script src="{{ Module::asset('wallet:libs/simplebar/simplebar.min.js') }}"></script>
        <script src="{{ Module::asset('wallet:libs/eva-icons/eva.min.js') }}"></script>

        <!-- apexcharts -->
        <script src="{{ Module::asset('wallet:libs/apexcharts/apexcharts.min.js') }}"></script>

        <!-- Vector map -->
        <script src="{{ Module::asset('wallet:libs/jsvectormap/js/jsvectormap.min.js') }}"></script>
        <script src="{{ Module::asset('wallet:libs/jsvectormap/maps/world-merc.js') }}"></script>

        <script src="{{ Module::asset('wallet:js/pages/dashboard.init.js') }}"></script>
        <script src="{{ Module::asset('wallet:js/app.js') }}"></script>
        <script>
            document.getElementById("app-style").setAttribute("href", "{{ Module::asset('wallet:css/app.min.css') }}");
            document.getElementById("bootstrap-style").setAttribute("href", "{{ Module::asset('wallet:css/bootstrap.min.css') }}");
         </script>

    </body>



<!-- Mirrored from themesdesign.in/webadmin/layouts/layouts-horizontal.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 15 Nov 2024 00:53:59 GMT -->
</html>
