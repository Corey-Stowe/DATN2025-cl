
<?php
use Artesaos\SEOTools\Facades\SEOTools;
?>
@extends('client::layouts.master')

@section('title')
    Tìm kiếm sản phẩm | Thời trang Phong cách Việt
@endsection
<style>


    </style>
@section('contents')

        <!-- Begin Kenne's Breadcrumb Area -->
        <div class="breadcrumb-area">
            <div class="container">
                <div class="breadcrumb-content">
                    <h2>Kết quả tìm kiếm</h2>
                    {{-- <ul>
                        <li><a href="index.html">Home</a></li>
                        <li class="active">Left Sidebar</li>
                    </ul> --}}
                </div>
            </div>
        </div>
        <!-- Kenne's Breadcrumb Area End Here -->

        <!-- Begin Kenne's Content Wrapper Area -->
        <div class="kenne-content_wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 order-2">
                        <div class="kenne-sidebar-catagories_area">
                            <div class="kenne-sidebar_categories">
                                <div class="kenne-categories_title first-child">
                                    <h5>Lọc bằng giá</h5>
                                </div>
                                <div class="price-filter">
                                    <form action="{{ route('searchprice') }}" method="GET">
                                        @csrf
                                        <div class="mb-3">
                                          <label for="lowPrice" class="form-label">Giá từ:</label>
                                          <div class="input-group">
                                            <span class="input-group-text">₫</span>
                                            <input type="number" class="form-control" id="lowPrice" name="lowprice" placeholder="Giá thấp nhất" value="@if(isset($_GET['lowprice'])){{ $_GET['lowprice'] }}@endif">
                                          </div>
                                        </div>
                                        <div class="mb-3">
                                          <label for="highPrice" class="form-label">Đến:</label>
                                          <div class="input-group">
                                            <span class="input-group-text">₫</span>
                                            <input type="number" class="form-control" id="highPrice" name="highprice" placeholder="Giá cao nhất" value="@if(isset($_GET['highprice'])){{ $_GET['highprice'] }}@endif">
                                          </div>
                                          <input type="hidden" name="keywd" value="{{ session()->get('keywd') }}">
                                        </div>
                                        <button type="submit" class="kenne-btn btn-dark w-100 ">Lọc</button>
                                        {{-- show error valiate --}}
                                        @if ($errors->any())
                                        <div class="alert alert-danger mt-3">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        @endif
                                      </form>
                                </div>
                            </div>
                            <div class="kenne-sidebar_categories category-module">
                                <div class="kenne-categories_title">
                                    <h5>Lọc theo loại sản phẩm</h5>
                                </div>
                                <div class="sidebar-categories_menu">
                                    <ul>
                                        <li><a href="{{ route('searchget',['keywd' => session()->get('keywd')]) }}">Tất cả danh mục</a></li>
                                      @foreach ( $listcategory  as $category)
                                        <li><a href="{{ route('seachcategory', ['id' => $category->id, 'keywd' => session()->get('keywd')]) }}">{{ $category->name }}</a></li>

                                      @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9 order-1">
                        <div class="shop-toolbar">
                            <div class="product-view-mode">
                                <a class="grid-3" data-target="gridview-3" data-toggle="tooltip" data-placement="top" title="Grid View"><i class="fa fa-th"></i></a>
                                <a class="active list" data-target="listview" data-toggle="tooltip" data-placement="top" title="List View"><i class="fa fa-th-list"></i></a>
                            </div>
                            {{-- <div class="product-page_count">
                                <p>Showing 1–9 of 40 results)</p>
                            </div> --}}
                            <div class="product-item-selection_area">
                                <div class="product-short">
                                    <label class="select-label">Lọc:</label>
                                   <form action="{{ route('shortingseach') }}" method="GET">
                                    @csrf
                                    <select name="fliter" id="short" class="nice-select">
                                        <option value="0">Mặc định</option>
                                        <option value="4">Giá: Tăng dần</option>
                                        <option value="3">Giá: Giảm dần</option>
                                        <option value="2">Tên: A-Z</option>
                                        <option value="1">Tên: Z-A</option>
                                    </select>
                                    <input type="hidden" name="keywd" value="{{ session()->get('keywd') }}">
                                    <button type="submit" class="btn-dark  btn-sm mt-1 ms-2" id="flitclick" onclick="submitbtn()">   <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M3.9 54.9C10.5 40.9 24.5 32 40 32l432 0c15.5 0 29.5 8.9 36.1 22.9s4.6 30.5-5.2 42.5L320 320.9 320 448c0 12.1-6.8 23.2-17.7 28.6s-23.8 4.3-33.5-3l-64-48c-8.1-6-12.8-15.5-12.8-25.6l0-79.1L9 97.3C-.7 85.4-2.8 68.8 3.9 54.9z"/></svg> </i> Lọc</button>
                                </form>
                                </div>
                            </div>
                        </div>
                        <div class="shop-product-wrap grid listview row">
                            @foreach ( $products as $list )
                            <div class="col-lg-4 col-md-4 col-sm-6">
                                <div class="product-item">
                                    <div class="single-product">
                                        <div class="product-img">
                                            <a href="{{ route('shop.productDetail', $list->slug) }}">
                                                <img class="primary-img" src="{{ \Storage::url($list->image_avatar) }}" alt="Kenne's Product Image">
                                                <img class="secondary-img" src="{{ \Storage::url($list->image_avatar) }}" alt="Kenne's Product Image">
                                            </a>
                                            <span class="sticker">-{{ $list->discount_percent }}%</span>
                                            {{-- <div class="add-actions">
                                                <ul>
                                                    <li class="quick-view-btn" data-bs-toggle="modal" data-bs-target="#exampleModalCenter"><a href="javascript:void(0)" data-bs-toggle="tooltip" data-placement="right" title="Quick View"><i class="ion-ios-search"></i></a>
                                                    </li>
                                                    <li><a href="wishlist.html" data-bs-toggle="tooltip" data-placement="right" title="Add To Wishlist"><i
                                                            class="ion-ios-heart-outline"></i></a>
                                                    </li>
                                                    <li><a href="compare.html" data-bs-toggle="tooltip" data-placement="right" title="Add To Compare"><i
                                                            class="ion-ios-reload"></i></a>
                                                    </li>
                                                    <li><a href="cart.html" data-bs-toggle="tooltip" data-placement="right" title="Add To cart"><i class="ion-bag"></i></a>
                                                    </li>
                                                </ul>
                                            </div> --}}
                                        </div>
                                        <div class="product-content">
                                            <div class="product-desc_info">
                                                <h3 class="product-name"><a href="{{ route('shop.productDetail', $list->slug) }}">{{ $list->name }}</a></h3>
                                                <div class="price-box">
                                                    <span class="new-price">
                                                        {{ number_format((int) ($list->discount_percent > 0 ? $list->price_regular * (1 - $list->discount_percent / 100) : ($list->price_sale > 0 ? $list->price_sale : $list->price_regular)), 0, ',', '.') }}
                                                        (VND)
                                                    </span>
                                                    @if ($list->discount_percent > 0 || $list->price_sale > 0)
                                                        <span class="old-price">
                                                            {{ number_format((int) $list->price_regular, 0, ',', '.') }}
                                                        </span>
                                                    @endif
                                                </div>
                                                {{-- <div class="rating-box">
                                                    <ul>
                                                        <li><i class="ion-ios-star"></i></li>
                                                        <li><i class="ion-ios-star"></i></li>
                                                        <li><i class="ion-ios-star"></i></li>
                                                        <li class="silver-color"><i class="ion-ios-star-half"></i></li>
                                                        <li class="silver-color"><i class="ion-ios-star-outline"></i>
                                                        </li>
                                                    </ul>
                                                </div> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="list-product_item">
                                    <div class="single-product">
                                        <div class="product-img">
                                            <a href="{{ route('shop.productDetail', $list->slug) }}">
                                                <img src="{{ \Storage::url($list->image_avatar) }}" alt="huh">
                                            </a>
                                        </div>
                                        <div class="product-content">
                                            <div class="product-desc_info">

                                                <div class="price-box">
                                                    <span class="new-price">
                                                        {{ number_format((int) ($list->discount_percent > 0 ? $list->price_regular * (1 - $list->discount_percent / 100) : ($list->price_sale > 0 ? $list->price_sale : $list->price_regular)), 0, ',', '.') }}
                                                        (VND)
                                                    </span>
                                                    @if ($list->discount_percent > 0 || $list->price_sale > 0)
                                                        <span class="old-price">
                                                            {{ number_format((int) $list->price_regular, 0, ',', '.') }}
                                                        </span>
                                                    @endif
                                                </div>
                                                <h6 class="product-name"><a href="{{ route('shop.productDetail', $list->slug) }}">{{ $list->name }}</a></h6>
                                                <div class="product-short_desc">
                                                    {!! $list->description !!}
                                                </div>
                                                {{-- <div class="rating-box">
                                                    <ul>
                                                        <li><i class="ion-ios-star"></i></li>
                                                        <li><i class="ion-ios-star"></i></li>
                                                        <li><i class="ion-ios-star"></i></li>
                                                        <li class="silver-color"><i class="ion-ios-star-half"></i></li>
                                                        <li class="silver-color"><i class="ion-ios-star-outline"></i>
                                                        </li>
                                                    </ul>
                                                </div> --}}

                                            </div>
                                            {{-- <div class="add-actions">
                                                <ul>
                                                    <li class="quick-view-btn" data-bs-toggle="modal" data-bs-target="#exampleModalCenter"><a href="javascript:void(0)" data-bs-toggle="tooltip" data-placement="top" title="Quick View"><i class="ion-ios-search"></i></a>
                                                    </li>
                                                    <li><a href="wishlist.html" data-bs-toggle="tooltip" data-placement="top" title="Add To Wishlist"><i
                                                            class="ion-ios-heart-outline"></i></a>
                                                    </li>
                                                    <li><a href="compare.html" data-bs-toggle="tooltip" data-placement="top" title="Add To Compare"><i class="ion-ios-reload"></i></a>
                                                    </li>
                                                    <li><a href="cart.html" data-bs-toggle="tooltip" data-placement="top" title="Add To cart"><i class="ion-bag"></i></a>
                                                    </li>
                                                </ul>
                                            </div> --}}
                                        </div>

                                    </div>
                                </div>
                            </div>
                            @endforeach
                            <div class="row mt-3">
                                <div class="col-lg-12">
                                    {{ $products->appends(['keywd' => $keywd])->links('pagination::bootstrap-5') }}
                                </div>
                            </div>
                        </div>
                        {{-- <div class="row">
                            <div class="col-lg-12">
                                <div class="kenne-paginatoin-area">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <ul class="kenne-pagination-box primary-color">
                                                <li class="active"><a href="javascript:void(0)">1</a></li>
                                                <li><a href="javascript:void(0)">2</a></li>
                                                <li><a href="javascript:void(0)">3</a></li>
                                                <li><a href="javascript:void(0)">4</a></li>
                                                <li><a href="javascript:void(0)">5</a></li>
                                                <li><a class="Next" href="javascript:void(0)">Next</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
        <!-- Kenne's Content Wrapper Area End Here -->

        <!-- Begin Brand Area -->
        {{-- <div class="brand-area ">
            <div class="container">
                <div class="brand-nav border-top ">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="kenne-element-carousel brand-slider slider-nav" data-slick-options='{
                                "slidesToShow": 6,
                                "slidesToScroll": 1,
                                "infinite": false,
                                "arrows": false,
                                "dots": false,
                                "spaceBetween": 30
                                }' data-slick-responsive='[
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
                                        <img src="assets/images/brand/1.png" alt="Brand Images">
                                    </a>
                                </div>
                                <div class="brand-item">
                                    <a href="javascript:void(0)">
                                        <img src="assets/images/brand/2.png" alt="Brand Images">
                                    </a>
                                </div>
                                <div class="brand-item">
                                    <a href="javascript:void(0)">
                                        <img src="assets/images/brand/3.png" alt="Brand Images">
                                    </a>
                                </div>
                                <div class="brand-item">
                                    <a href="javascript:void(0)">
                                        <img src="assets/images/brand/4.png" alt="Brand Images">
                                    </a>
                                </div>
                                <div class="brand-item">
                                    <a href="javascript:void(0)">
                                        <img src="assets/images/brand/5.png" alt="Brand Images">
                                    </a>
                                </div>
                                <div class="brand-item">
                                    <a href="javascript:void(0)">
                                        <img src="assets/images/brand/6.png" alt="Brand Images">
                                    </a>
                                </div>
                                <div class="brand-item">
                                    <a href="javascript:void(0)">
                                        <img src="assets/images/brand/1.png" alt="Brand Images">
                                    </a>
                                </div>
                                <div class="brand-item">
                                    <a href="javascript:void(0)">
                                        <img src="assets/images/brand/2.png" alt="Brand Images">
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        <script>
            function submitbtn() {
                document.getElementById("flitclick").click();
            }
        </script>
@endsection
