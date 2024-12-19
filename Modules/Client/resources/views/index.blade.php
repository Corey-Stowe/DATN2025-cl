@extends('client::layouts.master')
@section('title')
    Fashion | Thời trang Phong cách Việt
@endsection
@section('contents')
    {{-- @include('client::contents.homeWeb.slider-area') --}}
    <!-- Begin Slider Area -->
    <!-- Begin Slider Area -->
    @foreach ($slider as $key => $items)
        @php
            $url = $items->img_banner;
            if (!\Str::contains($url, 'http')) {
                $url = \Storage::url($url);
            }

        @endphp
        <style>
            .bg-{{ $loop->iteration }} {
                background-image: url('{{ $url }}');
            }
        </style>
    @endforeach

    <div class="slider-area">
        <div class="kenne-element-carousel home-slider arrow-style"
            data-slick-options='{
            "slidesToShow": 1,
            "slidesToScroll": 1,
            "infinite": true,
            "arrows": true,
            "dots": false,
            "autoplay" : true,
            "fade" : true,
            "autoplaySpeed" : 7000,
            "pauseOnHover" : false,
            "pauseOnFocus" : false
            }'
            data-slick-responsive='[
            {"breakpoint":768, "settings": {
            "slidesToShow": 1
            }},
            {"breakpoint":575, "settings": {
            "slidesToShow": 1
            }}
        ]'>
            @foreach ($slider as $key => $items)
                @php
                    $url = $items->img_banner;
                    if (!\Str::contains($url, 'http')) {
                        $url = \Storage::url($url);
                    }
                @endphp

                <div class="slide-item bg-1 animation-style-01" style="background-image: url('{{ $url }}');">
                    <div class="slider-progress"></div>
                    <div class="container">
                        <div class="slide-content">
                            <span>{{ $items->offer_text }}</span>
                            <h2>{{ $items->title }}</h2>
                            <p class="short-desc">{{ $items->description }}</p>
                            <div class="slide-btn">
                                <a class="kenne-btn" href="{{ $items->link }}">Mua sắm ngay</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <!-- Slider Area End Here -->
    <!-- Slider Area End Here -->

    <!-- Begin Service Area -->
    <div class="service-area">
        <div class="container">
            <div class="service-nav">
                <div class="row">
                    <div class="col-lg-4 col-md-4">
                        <div class="service-item">
                            <div class="content">
                                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor"
                                    class="bi bi-truck" viewBox="0 0 16 16">
                                    <path
                                        d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5zm1.294 7.456A2 2 0 0 1 4.732 11h5.536a2 2 0 0 1 .732-.732V3.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .294.456M12 10a2 2 0 0 1 1.732 1h.768a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12zm-9 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m9 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2" />
                                </svg>
                                <h4>Miễn phí vận chuyển</h4>
                                <p>Miễn phí vận chuyển cho mọi đơn hàng</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="service-item">
                            <div class="content">
                                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor"
                                    class="bi bi-cash-stack" viewBox="0 0 16 16">
                                    <path d="M1 3a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1zm7 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4" />
                                    <path
                                        d="M0 5a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1zm3 0a2 2 0 0 1-2 2v4a2 2 0 0 1 2 2h10a2 2 0 0 1 2-2V7a2 2 0 0 1-2-2z" />
                                </svg>
                                <h4>Hoàn trả tiền</h4>
                                <p>7 ngày trả hàng miễn phí</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="service-item">
                            <div class="content">
                                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor"
                                    class="bi bi-headset" viewBox="0 0 16 16">
                                    <path
                                        d="M8 1a5 5 0 0 0-5 5v1h1a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V6a6 6 0 1 1 12 0v6a2.5 2.5 0 0 1-2.5 2.5H9.366a1 1 0 0 1-.866.5h-1a1 1 0 1 1 0-2h1a1 1 0 0 1 .866.5H11.5A1.5 1.5 0 0 0 13 12h-1a1 1 0 0 1-1-1V8a1 1 0 0 1 1-1h1V6a5 5 0 0 0-5-5" />
                                </svg>
                                <h4>Hỗ trợ trực tuyến</h4>
                                <p>Hỗ trợ 24/24h</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Service Area End Here -->

    @include('client::contents.homeWeb.product-area')

    <!-- Begin Banner Area Two -->
    <div class="banner-area banner-area-2">
        <div class="container">
            <div class="row">
                @foreach ($bannercenter as $items)
                    @php
                        $url = $items->img_banner;
                        if (!\Str::contains($url, 'http')) {
                            $url = \Storage::url($url);
                        }
                    @endphp
                    <div class="col-md-6">
                        <div class="banner-item img-hover_effect">
                            <div class="banner-img">
                                <a href="{{ $items->link }}">
                                    <img src="{{ $url }}" alt="{{ $items->title }}">
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Banner Area Two End Here -->
    @include('client::contents.homeWeb.latest-blog_area')
    @php
        $url = $bannerbottom->first()->img_banner;
        if (!\Str::contains($url, 'http')) {
            $url = \Storage::url($url);
        }
    @endphp
    <style>
        .kenne-banner_area-4 {
            background-image: url('{{ $url }}');
            background-repeat: no-repeat;
            background-position: center center;
            background-size: cover;
            min-height: 565px;
            position: relative;
            padding-top: 0;
            margin-top: 90px;
        }
    </style>
    <!-- Begin Kenne's Banner Area Four -->
    <div class="kenne-banner_area kenne-banner_area-4">
        <div class="banner-img"></div>
        <div class="banner-content">
            <div class="kenne-btn-ps_center">
                <a class="kenne-btn transparent-btn" href="{{ route('shop.shopIndex') }}">Mua sắm ngay</a>
            </div>
        </div>
    </div>
    <!-- Kenne's Banner Area Four End Here -->

    <!-- Begin Kenne's Instagram Area -->
    {{-- <div class="kenne-instagram_area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="kenne-section_area">
                        <h3>Instagram Feed</h3>
                        <p> Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a
                            piece of classical</p>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="kenne-element-carousel instagram-slider arrow-style arrow-style-3"
                        data-slick-options='{
                "slidesToShow": 5,
                "slidesToScroll": 1,
                "infinite": false,
                "arrows": true,
                "dots": false,
                "spaceBetween": 30
                }'
                        data-slick-responsive='[
                {"breakpoint":1200, "settings": {
                "slidesToShow": 5
                }},
                {"breakpoint":992, "settings": {
                "slidesToShow": 4
                }},
                {"breakpoint":768, "settings": {
                "slidesToShow": 3
                }},
                {"breakpoint":576, "settings": {
                "slidesToShow": 2
                }},
                {"breakpoint":480, "settings": {
                "slidesToShow": 1
                }}
            ]'>

                        <div class="single-item img-hover_effect">
                            <div class="instagram-img">
                                <a href="javascript:void(0)">
                                    <img src="{{ asset('theme/client/images/instagram/1.jpg') }}"
                                        alt="Kenne's Instagram Image">
                                </a>
                            </div>
                        </div>
                        <div class="single-item img-hover_effect">
                            <div class="instagram-img">
                                <a href="javascript:void(0)">
                                    <img src="{{ asset('theme/client/images/instagram/2.jpg') }}"
                                        alt="Kenne's Instagram Image">
                                </a>
                            </div>
                        </div>
                        <div class="single-item img-hover_effect">
                            <div class="instagram-img">
                                <a href="javascript:void(0)">
                                    <img src="{{ asset('theme/client/images/instagram/3.jpg') }}"
                                        alt="Kenne's Instagram Image">
                                </a>
                            </div>
                        </div>
                        <div class="single-item img-hover_effect">
                            <div class="instagram-img">
                                <a href="javascript:void(0)">
                                    <img src="{{ asset('theme/client/images/instagram/4.jpg') }}"
                                        alt="Kenne's Instagram Image">
                                </a>
                            </div>
                        </div>
                        <div class="single-item img-hover_effect">
                            <div class="instagram-img">
                                <a href="javascript:void(0)">
                                    <img src="{{ asset('theme/client/images/instagram/5.jpg') }}"
                                        alt="Kenne's Instagram Image">
                                </a>
                            </div>
                        </div>
                        <div class="single-item img-hover_effect">
                            <div class="instagram-img">
                                <a href="javascript:void(0)">
                                    <img src="{{ asset('theme/client/images/instagram/6.jpg') }}"
                                        alt="Kenne's Instagram Image">
                                </a>
                            </div>
                        </div>
                        <div class="single-item img-hover_effect">
                            <div class="instagram-img">
                                <a href="javascript:void(0)">
                                    <img src="{{ asset('theme/client/images/instagram/7.jpg') }}"
                                        alt="Kenne's Instagram Image">
                                </a>
                            </div>
                        </div>
                        <div class="single-item img-hover_effect">
                            <div class="instagram-img">
                                <a href="javascript:void(0)">
                                    <img src="{{ asset('theme/client/images/instagram/1.jpg') }}"
                                        alt="Kenne's Instagram Image">
                                </a>
                            </div>
                        </div>
                        <div class="single-item img-hover_effect">
                            <div class="instagram-img">
                                <a href="javascript:void(0)">
                                    <img src="{{ asset('theme/client/images/instagram/2.jpg') }}"
                                        alt="Kenne's Instagram Image">
                                </a>
                            </div>
                        </div>
                        <div class="single-item img-hover_effect">
                            <div class="instagram-img">
                                <a href="javascript:void(0)">
                                    <img src="{{ asset('theme/client/images/instagram/3.jpg') }}"
                                        alt="Kenne's Instagram Image">
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- Kenne's Instagram Area End Here -->
@endsection
