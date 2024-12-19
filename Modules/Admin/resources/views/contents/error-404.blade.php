<!DOCTYPE html>
<html data-bs-theme="light" lang="en-US" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PAGE NOT FOUND</title>
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

    <!-- ===============================================--><!--    Stylesheets--><!-- ===============================================-->
    <link rel="preconnect" href="https://fonts.gstatic.com/">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,500,600,700%7cPoppins:300,400,500,600,700,800,900&amp;display=swap"
        rel="stylesheet">
    <link href="{{ asset('theme/admin/css/theme-rtl.min.css') }}" rel="stylesheet" id="style-rtl">
    <link href="{{ asset('theme/admin/css/theme.min.css') }}" rel="stylesheet" id="style-default">
    <link href="{{ asset('theme/admin/css/user-rtl.min.css') }}" rel="stylesheet" id="user-style-rtl">
    <link href="{{ asset('theme/admin/css/user.min.css') }}" rel="stylesheet" id="user-style-default">
</head>

<body>
    <main class="main" id="top">
        <div class="container" data-layout="container">
            <div class="row flex-center min-vh-100 py-6 text-center">
                <div class="col-sm-10 col-md-8 col-lg-6 col-xxl-5"><a class="d-flex flex-center mb-4"
                        href="{{ route('admin.dashboard') }}"><img class="me-2"
                            src="{{ asset('theme/admin/img/icons/spot-illustrations/falcon.png') }}" alt=""
                            width="80" />
                    <div class="card">
                        <div class="card-body p-4 p-sm-5">
                            <div class="fw-black lh-1 text-300 fs-error">404</div>
                            <p class="lead mt-4 text-800 font-sans-serif fw-semi-bold w-md-75 w-xl-100 mx-auto">
                                @if (isset($error))
                                    {{ $error }}
                                @else
                                    Không tìm thấy đường dẫn cho trang này!
                                @endif
                            </p>
                            <hr />
                            <p>Có thể bạn đã thao tác sai hành động nào đó, hãy quay lại trang chủ và kiển tra lại!</p>
                            <a class="btn btn-primary btn-sm mt-3" href="{{ route('admin.dashboard') }}"><span
                                    class="fas fa-home me-2"></span>Quay lại trang chủ</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>
