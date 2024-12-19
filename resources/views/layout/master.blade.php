<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <html data-bs-theme="light" lang="en-US" dir="ltr">
    <meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->

    <!-- ===============================================--><!--    Document Title--><!-- ===============================================-->
    <title>@yield('title')</title>

    <!-- ===============================================--><!--    Favicons--><!-- ===============================================-->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('theme/admin/img/favicons/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32"
        href="{{ asset('theme/admin/img/favicons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16"
        href="{{ asset('theme/admin/img/favicons/favicon-16x16.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('theme/admin/img/favicons/favicon.ico') }}">
    <link rel="manifest" href="{{ asset('theme/admin/img/favicons/manifest.json') }}">
    <meta name="msapplication-TileImage" content="{{ asset('theme/admin/img/favicons/mstile-150x150.png') }}">
    <meta name="theme-color" content="#ffffff">
    <script src="{{ asset('theme/admin/js/config.js') }}"></script>
    <script src="{{ asset('theme/admin/vendors/simplebar/simplebar.min.js') }}"></script>
    @yield('css-libs')
    @include('admin.assets.link-assets.link-css')
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
            @include('admin.assets.nav-toggle.navbar-top')
            @include('admin.assets.nav-toggle.navbar-vertical')
            @include('admin.assets.nav-toggle.navbar-combo')
            <div class="content">
                @include('admin.assets.nav-contents.navbar-top-content')
                @include('admin.assets.nav-contents.navbar-combo-content')
                @include('admin.assets.nav-contents.nav-script')
                @yield('contents')
                @include('admin.assets.footer.footer-content')
            </div>
            @include('admin.assets.footer.authentication-modal')
        </div>
    </main>
    <!-- ===============================================--><!--    End of Main Content--><!-- ===============================================-->

    @include('admin.assets.footer.settings-panel')
    @include('admin.assets.footer.setting-toggle')
    @yield('js-libs')
    {{-- @include('admin.assets.link-assets.link-js') --}}
    @include('admin.assets.link-assets.link-js')
    @yield('js-setting')
</body>

</html>
