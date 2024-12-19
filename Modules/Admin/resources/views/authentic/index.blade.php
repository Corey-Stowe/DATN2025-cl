<!DOCTYPE html>
<html data-bs-theme="light" lang="en-US" dir="ltr">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- ===============================================--><!--    Document Title--><!-- ===============================================-->
    <title>Đăng nhập vào Trang quản trị</title>

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

    <!-- ===============================================--><!--    Stylesheets--><!-- ===============================================-->
    <link rel="preconnect" href="https://fonts.gstatic.com/">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,500,600,700%7cPoppins:300,400,500,600,700,800,900&amp;display=swap"
        rel="stylesheet">
    <link href="{{ asset('theme/admin/vendors/simplebar/simplebar.min.css') }}" rel="stylesheet">
    <link href="{{ asset('theme/admin/css/theme-rtl.min.css') }}" rel="stylesheet" id="style-rtl">
    <link href="{{ asset('theme/admin/css/theme.min.css') }}" rel="stylesheet" id="style-default">
    <link href="{{ asset('theme/admin/css/user-rtl.min.css') }}" rel="stylesheet" id="user-style-rtl">
    <link href="{{ asset('theme/admin/css/user.min.css') }}" rel="stylesheet" id="user-style-default">
    <script>
        var isRTL = JSON.parse(localStorage.getItem('isRTL'));
        if (isRTL) {
            var linkDefault = document.getElementById('style-default');
            var userLinkDefault = document.getElementById('user-style-default');
            linkDefault.setAttribute('disabled', true);
            userLinkDefault.setAttribute('disabled', true);
            document.querySelector('html').setAttribute('dir', 'rtl');
        } else {
            var linkRTL = document.getElementById('style-rtl');
            var userLinkRTL = document.getElementById('user-style-rtl');
            linkRTL.setAttribute('disabled', true);
            userLinkRTL.setAttribute('disabled', true);
        }
    </script>
</head>

<body>
    <main class="main" id="top">
        <div class="container-fluid">
            <script>
                var isFluid = JSON.parse(localStorage.getItem('isFluid'));
                if (isFluid) {
                    var container = document.querySelector('[data-layout]');
                    container.classList.remove('container');
                    container.classList.add('container-fluid');
                }
            </script>
            <div class="row min-vh-100 bg-100">
                <div class="col-6 d-none d-lg-block position-relative">
                    <div class="bg-holder"
                        style="background-image:url({{ asset('theme/admin/img/generic/14.jpg') }});background-position: 50% 20%;">
                    </div>
                </div>
                <div class="col-sm-10 col-md-6 px-sm-0 align-self-center mx-auto py-5">
                    <div class="row justify-content-center g-0">
                        <div class="col-lg-9 col-xl-8 col-xxl-6">
                            <div class="card">
                                <div class="card-header bg-circle-shape bg-shape text-center p-2">
                                    <a class="font-sans-serif fw-bolder fs-5 z-1 position-relative link-light"
                                        href="#" data-bs-theme="light">falcon</a>
                                </div>
                                <div class="card-body p-4">
                                    <div class="row flex-between-center mb-4">
                                        <div class="col-auto">
                                            <h3>Đăng nhập vào tài khoản Quản trị viên</h3>
                                        </div>
                                        <div class="col-auto fs-10 text-600">
                                            <span class="mb-0 fw-semi-bold">Nhập Email của bạn và Mật khẩu để đăng
                                                nhập</span>
                                        </div>
                                    </div>
                                    <form action="{{ route('loginAdmin') }}" method="POST">
                                        @csrf
                                        <div class="mb-3">
                                            <label class="form-label" for="split-login-email">Địa chỉ Email</label>
                                            <input class="form-control" id="split-login-email" type="email"
                                                placeholder="Nhập Email" name="email" tabindex="0" value=""
                                                required="" />
                                        </div>
                                        <div class="mb-3">
                                            <div class="d-flex justify-content-between">
                                                <label class="form-label" for="split-login-password">Mật khẩu</label>
                                            </div>
                                            <input class="form-control" id="split-login-password" type="password"
                                                placeholder="Nhập mật khẩu" name="password" tabindex="0"
                                                value="" required="" />
                                        </div>
                                        @if (session('error'))
                                            <label class="form-label text-danger">{{ session('error') }}</label>
                                        @endif
                                        <div class="row flex-between-center">
                                            <div class="col-auto">
                                                <div class="form-check mb-0">
                                                    <input class="form-check-input" type="checkbox" id="split-checkbox"
                                                        name="remember" />
                                                    <label class="form-check-label mb-0" for="split-checkbox">Ghi nhớ
                                                        tôi</label>
                                                </div>
                                            </div>
                                            <div class="col-auto"><a class="fs-10"
                                                    href="{{ route('admin.forgot.password') }}">Quên mật khẩu?</a>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <button class="btn btn-primary d-block w-100 mt-3" type="submit"
                                                name="submit">Đăng nhập</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="{{ asset('theme/admin/vendors/popper/popper.min.js') }}"></script>
    <script src="{{ asset('theme/admin/vendors/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('theme/admin/vendors/anchorjs/anchor.min.js') }}"></script>
    <script src="{{ asset('theme/admin/vendors/is/is.min.js') }}"></script>
    <script src="{{ asset('theme/admin/vendors/fontawesome/all.min.js') }}"></script>
    <script src="{{ asset('theme/admin/vendors/lodash/lodash.min.js') }}"></script>
    <script src="{{ asset('theme/admin/js/polyfill.min58be.js') }}?features=window.scroll"></script>
    <script src="{{ asset('theme/admin/vendors/list.js/list.min.js') }}"></script>
    <script src="{{ asset('theme/admin/js/theme.js') }}"></script>
</body>

</html>
