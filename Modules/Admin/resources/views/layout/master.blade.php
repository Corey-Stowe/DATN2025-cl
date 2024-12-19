<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <html data-bs-theme="light" lang="en-US" dir="ltr">
    <meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- ===============================================--><!--    Document Title--><!-- ===============================================-->
    <title>@yield('title')</title>

    <!-- ===============================================--><!--    Favicons--><!-- ===============================================-->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('theme/admin/img/favicons/apple-touch-icon.png') }}">
    <link rel="icon" type="{{ asset('image/png') }}" sizes="32x32"
        href="{{ asset('theme/admin/img/favicons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16"
        href="{{ asset('theme/admin/img/favicons/favicon-16x16.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('theme/admin/img/favicons/favicon.ico') }}">
    <link rel="manifest" href="{{ asset('theme/admin/img/favicons/manifest.json') }}">
    <meta name="msapplication-TileImage" content="{{ asset('theme/admin/img/favicons/mstile-150x150.png') }}">
    <meta name="theme-color" content="#ffffff">
    <script src="{{ asset('theme/admin/js/config.js') }}"></script>
    <script src="{{ asset('theme/admin/vendors/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('jquery/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('toastr/toastr.min.css') }}"></script>
    <script src="{{ asset('toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('pusher/pusher.min.js') }}"></script>
    {{-- <script src="{{ asset('sweetalert2/sweetalert2.min.css') }}"></script> --}}
    <script>
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('6b2509032695e872d989', {
            cluster: 'ap1'
        });

        // var channel = pusher.subscribe('client-channel');
        // channel.bind('new-order', function(data) {
        //     Swal.fire({
        //         title: 'Có đơn hàng mới!',
        //         text: JSON.stringify(data),
        //         icon: 'info',
        //         confirmButtonText: 'OK',
        //         timer: 5000
        //     });
        // });
        const channel = pusher.subscribe('client-channel');
        channel.bind('new-order', function(data) {
            // Display the notification using Toastr
            toastr.info(`Đơn hàng ${JSON.stringify(data)}`, 'Thông báo Có đơn hàng mới!', {
                closeButton: true,
                progressBar: true,
                positionClass: 'toast-top-right',
                timeOut: 5000
            });
        });
        channel.bind('new-user', function(data) {
            // Display the notification using Toastr
            toastr.info(`Tài khoản ${JSON.stringify(data)}`, 'Thông báo Có khách hàng mới!', {
                closeButton: true,
                progressBar: true,
                positionClass: 'toast-top-right',
                timeOut: 5000
            });
        });
    </script>
    @yield('css-libs')
    @include('admin::assets.link-assets.link-css')
    @yield('css-setting')
</head>

<body>
    <!-- ===============================================--><!--    Main Content--><!-- ===============================================-->
    <main class="main" id="top">
        <div class="container" data-layout="container">
            <script>
                var isFluid = JSON.parse(localStorage.getItem('isFluid'));
                if (isFluid) {
                    var container = document.querySelector('[data-layout]');
                    container.classList.remove('container');
                    container.classList.add('container-fluid');
                }
            </script>
            @include('admin::assets.nav-toggle.navbar-top')
            @include('admin::assets.nav-toggle.navbar-vertical')
            @include('admin::assets.nav-toggle.navbar-combo')
            <div class="content">
                @include('admin::assets.nav-contents.navbar-top-content')
                @include('admin::assets.nav-contents.navbar-combo-content')
                @include('admin::assets.nav-contents.nav-script')
                @yield('contents')
                @include('admin::assets.footer.footer-content')
            </div>
            @include('admin::assets.footer.authentication-modal')
        </div>
    </main>
    <!-- ===============================================--><!--    End of Main Content--><!-- ===============================================-->

    {{-- @include('admin::assets.footer.settings-panel') --}}
    {{-- @include('admin::assets.footer.setting-toggle') --}}
    @yield('js-libs')
    {{-- @include('admin.assets.link-assets.link-js') --}}
    @include('admin::assets.link-assets.link-js')
    @yield('js-setting')
</body>

</html>
