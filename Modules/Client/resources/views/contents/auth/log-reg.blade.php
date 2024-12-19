@extends('client::layouts.master')

@section('title')
    Đăng nhập tài khoản
@endsection
@section('contents')
    <!-- Begin Kenne's Breadcrumb Area -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="breadcrumb-content">
                <h2 style="margin-top: 30px;">Thời trang Phong cách Việt</h2>
                <ul>
                    <li><a href="{{ route('index') }}">Trang chủ</a></li>
                    <li class="active">Đăng nhập</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Kenne's Breadcrumb Area End Here -->

    <!-- Begin Kenne's Login Register Area -->
    <div class="kenne-login-register_area">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-sm-12 col-md-12 col-xs-12 col-lg-6">
                    <!-- Login Form s-->
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="login-form">
                            <h4 class="login-title">Đăng nhập</h4>

                            <div class="row">
                                <div class="col-md-12 col-12">
                                    <label>Email : </label>
                                    <input type="email" name='email' placeholder="Email Address">
                                </div>
                                <div class="col-12 mb--20">
                                    <label>Mật Khẩu</label>
                                    <input type="password" name='password' placeholder="Password">
                                    <span class="toggle-password" onclick="togglePassword('login-password')">👁️</span>
                                </div>
                                <div style="color: red">
                                    @error('Error')
                                        {{ $message }}
                                    @enderror
                                </div>
                                <div class="col-md-8">
                                    <div class="check-box">
                                        <input type="checkbox" id="remember_me">
                                        <label for="remember_me">Lưu mật khẩu</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="forgotton-password_info">
                                        <a href="{{route('forgot-password')}}"> Quên mật khẩu ? </a>
                                    </div>
                                </div>

                                <div class="col-md-12 d-flex justify-content-between align-items-center">
                                    <div class="col-md-12">
                                        <div class="d-flex justify-content-center gap-2">
                                            <button class="btn kenne-register_btn w-100" type="submit">Đăng nhập</button>
                                            <a href="{{ route('auth.google') }}" class="btn a-register_btn w-100">
                                                <i class="ri-google-fill me-1"></i> Google
                                            </a>
                                        </div>

                                        <div class="mt-4 text-center">
                                            <p class="mb-0">Bạn chưa có tài khoản rồi <a href="{{ route('formReg') }}"
                                                    class="fw-semibold text-primary text-decoration-underline"> Đăng ký </a> </p>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Kenne's Login Register Area  End Here -->

    <!-- Begin Brand Area -->
    <div class="brand-area ">
        <div class="container">
            <div class="brand-nav border-top ">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="kenne-element-carousel brand-slider slider-nav"
                            data-slick-options='{
                            "slidesToShow": 6,
                            "slidesToScroll": 1,
                            "infinite": false,
                            "arrows": false,
                            "dots": false,
                            "spaceBetween": 30
                            }'
                            data-slick-responsive='[
                            {"breakpoint":992, "settings": {
                            "slidesToShow": 4
                            }},
                            {"breakpoint":768, "settings": {
                            "slidesToShow": 3
                            }},
                            {"breakpoint":576, "settings": {
                            "slidesToShow": 2
                            }}
                        ]'>

                            <div class="brand-item">
                                <a href="javascript:void(0)">
                                    <img src="{{ asset('theme/client/images/brand/1.png') }}" alt="Brand Images">
                                </a>
                            </div>
                            <div class="brand-item">
                                <a href="javascript:void(0)">
                                    <img src="{{ asset('theme/client/images/brand/2.png') }}" alt="Brand Images">
                                </a>
                            </div>
                            <div class="brand-item">
                                <a href="javascript:void(0)">
                                    <img src="{{ asset('theme/client/images/brand/3.png') }}" alt="Brand Images">
                                </a>
                            </div>
                            <div class="brand-item">
                                <a href="javascript:void(0)">
                                    <img src="{{ asset('theme/client/images/brand/4.png') }}" alt="Brand Images">
                                </a>
                            </div>
                            <div class="brand-item">
                                <a href="javascript:void(0)">
                                    <img src="{{ asset('theme/client/images/brand/5.png') }}" alt="Brand Images">
                                </a>
                            </div>
                            <div class="brand-item">
                                <a href="javascript:void(0)">
                                    <img src="{{ asset('theme/client/images/brand/6.png') }}" alt="Brand Images">
                                </a>
                            </div>
                            <div class="brand-item">
                                <a href="javascript:void(0)">
                                    <img src="{{ asset('theme/client/images/brand/1.png') }}" alt="Brand Images">
                                </a>
                            </div>
                            <div class="brand-item">
                                <a href="javascript:void(0)">
                                    <img src="{{ asset('theme/client/images/brand/2.png') }}" alt="Brand Images">
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Brand Area End Here -->
@endsection
@section('css-setting')
    <style>
        a.a-register_btn {
            text-align: center;
            background-color: #242424;
            color: #ffffff;
            display: block;
            margin-top: 15px;
            width: 140px;
            border-radius: 0;
            height: 40px;
            line-height: 40px;
            border: 0;
            text-transform: uppercase;
        }

        a.a-register_btn:hover {
            background-color: #a8741a;
            color: #ffffff;
        }
    </style>
@endsection
