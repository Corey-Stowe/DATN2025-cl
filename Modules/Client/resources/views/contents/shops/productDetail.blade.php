@extends('client::layouts.master')

@section('title')
    Chi tiết | Tên sản phẩm
@endsection
@section('contents')
    <!-- Begin Kenne's Breadcrumb Area -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="breadcrumb-content">
                <h2 style="margin-top: 30px;">Thời trang Phong cách Việt</h2>
                <ul>
                    <li><a href="{{ route('index') }}">Trang chủ</a></li>
                    <li class="active">Chi tiết sản phẩm</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Kenne's Breadcrumb Area End Here -->

    <!-- Begin Kenne's Single Product Variable Area -->
    <div class="sp-area">
        <div class="container">
            <div class="sp-nav">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="sp-img_area">
                            <div class="sp-img_slider slick-img-slider kenne-element-carousel"
                                data-slick-options='{
                            "slidesToShow": 1,
                            "arrows": false,
                            "fade": true,
                            "draggable": false,
                            "swipe": false,
                            "asNavFor": ".sp-img_slider-nav"
                            }'>
                                @php
                                    $avt = $data->image_avatar;
                                    if (!\Str::contains($avt, 'http')) {
                                        $avt = \Storage::url($avt);
                                    }
                                @endphp
                                <div class="single-slide zoom">
                                    <img src="{{ $avt }}" alt="Kenne's Product Image">
                                </div>
                                @foreach ($data->images as $image)
                                    @php
                                        $glr = $image->image_path;
                                        if (!\Str::contains($glr, 'http')) {
                                            $glr = \Storage::url($glr);
                                        }
                                    @endphp
                                    <div class="single-slide zoom">
                                        <img src="{{ $glr }}" alt="Kenne's Product Image">
                                    </div>
                                @endforeach
                            </div>
                            <div class="sp-img_slider-nav slick-slider-nav kenne-element-carousel arrow-style-2 arrow-style-3"
                                data-slick-options='{
                            "slidesToShow": 3,
                            "asNavFor": ".sp-img_slider",
                            "focusOnSelect": true,
                            "arrows" : true,
                            "spaceBetween": 30
                            }'
                                data-slick-responsive='[
                                    {"breakpoint":1501, "settings": {"slidesToShow": 3}},
                                    {"breakpoint":1200, "settings": {"slidesToShow": 2}},
                                    {"breakpoint":992, "settings": {"slidesToShow": 4}},
                                    {"breakpoint":768, "settings": {"slidesToShow": 3}},
                                    {"breakpoint":575, "settings": {"slidesToShow": 2}}
                                ]'>
                                <div class="single-slide">
                                    <img src="{{ $avt }}" alt="Kenne's Product Thumnail">
                                </div>
                                @foreach ($data->images as $image)
                                    @php
                                        $glr = $image->image_path;
                                        if (!\Str::contains($glr, 'http')) {
                                            $glr = \Storage::url($glr);
                                        }
                                    @endphp
                                    <div class="single-slide">
                                        <img src="{{ $glr }}" alt="Kenne's Product Image">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <form action="" class="sp-content" method="POST">
                            @csrf
                            <div class="sp-heading">
                                <h5><a href="{{ route('shop.productDetail', $data->slug) }}">{{ $data->name }}</a></h5>
                            </div>
                            <span class="reference">Mã sản phẩm: {{ $data->sku }}</span>
                            @if (count($comments) > 0)
                                <div class="rating-box">
                                    <ul>
                                        @for ($i = 0; $i < $averageRating; $i++)
                                            <li><i class="ion-android-star"></i></li>
                                        @endfor
                                    </ul>
                                </div>
                            @else
                                <div class="rating-box">
                                    <span class="reference text-warning">Hiện tại chưa có đánh giá nào cho sản phẩm
                                        này!</span>
                                </div>
                            @endif
                            <div class="sp-essential_stuff">
                                <ul class="load-infor" id="load-infor">
                                    <li>Số lượng: <a
                                            href="javascript:void(0)">{{ $dataq->first()->total_variants_products != null ? $dataq->first()->total_variants_products : 0 }}</a>
                                    </li>
                                    <li>Tình trạng: <a href="javascript:void(0)">
                                            {{ $dataq->first()->total_variants_productsy > 5 && $dataq->first()->total_variants_products > 0
                                                ? 'Sắp hết hàng'
                                                : ($dataq->first()->total_variants_products == 0
                                                    ? 'Hết hàng'
                                                    : 'Còn hàng') }}
                                        </a>
                                    </li>
                                    @if ($data->discount_percent > 0 || $data->price_sale > 0)
                                        <li>Giá mặc định: <a href="javascript:void(0)">
                                                <strike>
                                                    {{ number_format((int) $data->price_regular, 0, ',', '.') }} (VNĐ)
                                                </strike>
                                            </a>
                                        </li>
                                        <li>Giá khuyến mại: <a href="javascript:void(0)">
                                                <strong>
                                                    {{ number_format(
                                                        (int) ($data->discount_percent > 0
                                                            ? $data->price_regular * (1 - $data->discount_percent / 100)
                                                            : ($data->price_sale > 0
                                                                ? $data->price_sale
                                                                : $data->price_regular)),
                                                        0,
                                                        ',',
                                                        '.',
                                                    ) }}
                                                    (VNĐ)
                                                </strong>
                                            </a>
                                        </li>
                                    @else
                                        <li>Giá mặc định: <a href="javascript:void(0)">
                                                <strong>
                                                    {{ number_format((int) $data->price_regular, 0, ',', '.') }} (VNĐ)
                                                </strong>
                                            </a>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                            <div class="color-list_area row">
                                {{-- <div class="color-list_heading">
                                    <h4>Tùy chọn biến thể</h4>
                                </div> --}}
                                <div class="col-lg-6 pe-lg-2">
                                    <label class="form-label">Kích thước</label>
                                    <div class="product-size_box">
                                        @php
                                            $size = $data->product_variants
                                                ->pluck('size')
                                                ->flatten(1)
                                                ->unique('id')
                                                ->values();
                                        @endphp
                                        <select class="myniceselect nice-select" name="id_size" id="id_size">
                                            <option value="" selected>
                                                Chọn size
                                            </option>
                                            @foreach ($size as $item)
                                                <option value="{{ $item->id }}">
                                                    {{ $item->size_value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 pe-lg-2">
                                    <span class="sub-title">Màu</span>
                                    <div class="color-list" id="color-list">
                                        <strong class="text-warning border" style="padding: 5px;">
                                            Vui lòng chọn kích thước!
                                        </strong>
                                    </div>
                                </div>
                            </div>
                            <div class="quantity">
                                <label>Số lượng</label>
                                <div class="cart-plus-minus">
                                    <input class="cart-plus-minus-box" id="quantity-input" value="1" min="1"
                                        type="text">
                                    <div class="dec qtybutton"><i class="fa fa-angle-down"></i></div>
                                    <div class="inc qtybutton"><i class="fa fa-angle-up"></i></div>
                                </div>
                            </div>
                            <div class="qty-btn_area">
                                <ul>
                                    <li>
                                        <button type="submit" class="add-to-cart kenne-register_btn"
                                            data-product-id="{{ $data->id }}">Thêm vào giỏ hàng</button>
                                    </li>
                                    <li>
                                        <a class="qty-wishlist_btn add-to-wishlist " href="#"
                                            data-product-id="{{ $data->id }}" data-bs-toggle="tooltip"
                                            title="Thêm vào yêu thích">
                                            <i class="ion-android-favorite-outline"></i>
                                        </a>

                                    </li>
                                </ul>
                            </div>
                            <div class="kenne-tag-line">
                                <h6>Thẻ: &nbsp;</h6>
                                @if (count($data->tags) > 0)
                                    @foreach ($data->tags as $tag)
                                        <span class="badge bg-info">{{ $tag->name }}</span> &nbsp; &nbsp;
                                    @endforeach
                                @else
                                    <span class="badge bg-warning">Không có thẻ nào gắn cho sản phẩm này!</span> &nbsp;
                                    &nbsp;
                                @endif
                            </div>
                            <div class="kenne-social_link">
                                <ul>
                                    <li class="facebook">
                                        <a href="https://www.facebook.com/" data-bs-toggle="tooltip" target="_blank"
                                            title="Facebook">
                                            <i class="fab fa-facebook"></i>
                                        </a>
                                    </li>
                                    <li class="twitter">
                                        <a href="https://twitter.com/" data-bs-toggle="tooltip" target="_blank"
                                            title="Twitter">
                                            <i class="fab fa-twitter-square"></i>
                                        </a>
                                    </li>
                                    <li class="youtube">
                                        <a href="https://www.youtube.com/" data-bs-toggle="tooltip" target="_blank"
                                            title="Youtube">
                                            <i class="fab fa-youtube"></i>
                                        </a>
                                    </li>
                                    <li class="google-plus">
                                        <a href="https://www.plus.google.com/discover" data-bs-toggle="tooltip"
                                            target="_blank" title="Google Plus">
                                            <i class="fab fa-google-plus"></i>
                                        </a>
                                    </li>
                                    <li class="instagram">
                                        <a href="https://rss.com/" data-bs-toggle="tooltip" target="_blank"
                                            title="Instagram">
                                            <i class="fab fa-instagram"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- Kenne's Single Product Variable Area End Here -->

    <!-- Begin Product Tab Area Two -->
    <div class="product-tab_area-2">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="sp-product-tab_nav">
                        <div class="product-tab">
                            <ul class="nav product-menu">
                                <li><a class="active" data-bs-toggle="tab" href="#description"><span>Mô tả sản
                                            phẩm</span></a>
                                </li>
                                <li><a data-bs-toggle="tab" href="#reviews"><span>Bình luận - Đánh giá</span></a></li>
                            </ul>
                        </div>
                        <div class="tab-content uren-tab_content">
                            <div id="description" class="tab-pane active show" role="tabpanel">
                                <div class="product-description">
                                    {!! $data->description !!}
                                </div>
                            </div>
                            <div id="reviews" class="tab-pane" role="tabpanel">
                                <div class="tab-pane active" id="tab-review">
                                    <form class="form-horizontal" id="form-review" action="{{ route('submit-review') }}"
                                        method="POST">
                                        @csrf
                                        <div id="review">
                                            <h2>Đánh giá sản phẩm</h2>
                                            @if ($comments->count() > 0)
                                                <table class="table table-striped table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <td>Email khách hàng</td>
                                                            <td>Nội dung</td>
                                                            <td>Đánh giá</td>
                                                            <td>Ngày bình luận</td>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($comments as $comment)
                                                            <tr>
                                                                <td style="width: 50%;"><strong>
                                                                        @php
                                                                            $email =
                                                                                $comment->user->email ?? 'Khách hàng';
                                                                            // Kiểm tra nếu email có tồn tại
                                                                            if (strpos($email, '@')) {
                                                                                $username = substr(
                                                                                    $email,
                                                                                    0,
                                                                                    strpos($email, '@'),
                                                                                ); // Lấy phần trước dấu "@"
                                                                                $domain = substr(
                                                                                    $email,
                                                                                    strpos($email, '@'),
                                                                                ); // Lấy phần sau dấu "@"
                                                                                // Hiển thị 3 ký tự đầu và thay phần còn lại bằng dấu sao
                                                                                $usernameMasked =
                                                                                    substr($username, 0, 3) .
                                                                                    str_repeat(
                                                                                        '*',
                                                                                        strlen($username) - 3,
                                                                                    );
                                                                                echo $usernameMasked . $domain;
                                                                            } else {
                                                                                echo $email; // Nếu không phải email, hiển thị "Khách hàng"
                                                                            }
                                                                        @endphp
                                                                    </strong></td>
                                                                <td>
                                                                    <p>{{ $comment->comments }}</p>
                                                                </td>
                                                                <td class="text-right">{{ $comment->rating }} <i
                                                                        class="ion-android-star"></i> </td>
                                                                <td class="text-right">
                                                                    {{ \Carbon\Carbon::parse($comment->comment_date)->format('d/m/Y') }}
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            @else
                                                <p>Hiện tại chưa có đánh giá nào cho sản phẩm này.</p>
                                            @endif
                                        </div>
                                        @if (Auth::check())
                                            <h2>Viết đánh giá</h2>
                                            <input type="hidden" name="product_id" value="{{ $data->id }}">
                                            <!-- ID sản phẩm -->
                                            <div class="form-group required">
                                                <div class="col-sm-12 p-0">
                                                    <label>Email của bạn <span class="required">*</span></label>
                                                    <input class="review-input" type="email"
                                                        value="{{ Auth::user()->email }}" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group required second-child">
                                                <div class="col-sm-12 p-0">
                                                    <label>Ý kiến của bạn</label>
                                                    <textarea class="review-textarea" name="comments" required></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group last-child required">
                                                <div class="col-sm-12 p-0">
                                                    <div class="your-opinion">
                                                        <label>Đánh giá của bạn</label>
                                                        <select class="star-rating" name="rating" required>
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                            <option value="5">5</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="kenne-btn-ps_right">
                                                    <button type="submit" class="kenne-btn">Gửi đánh giá</button>
                                                </div>
                                            </div>
                                        @else
                                            <div class="login-required">
                                                <p>Bạn cần đăng nhập để bình luận.</p>
                                            </div>
                                        @endif
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Product Tab Area Two End Here -->

    <!-- Begin Product Area -->
    <div class="product-area pb-90">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h3>Sản phẩm tương tự</h3>
                        <div class="product-arrow"></div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="kenne-element-carousel product-slider slider-nav"
                        data-slick-options='{
                    "slidesToShow": 4,
                    "slidesToScroll": 1,
                    "infinite": false,
                    "arrows": true,
                    "dots": false,
                    "spaceBetween": 30,
                    "appendArrows": ".product-arrow"
                    }'
                        data-slick-responsive='[
                    {"breakpoint":992, "settings": {
                    "slidesToShow": 3
                    }},
                    {"breakpoint":768, "settings": {
                    "slidesToShow": 2
                    }},
                    {"breakpoint":575, "settings": {
                    "slidesToShow": 1
                    }}
                ]'>
                        @foreach ($realedProducts as $product)
                            @php
                                $avt = $product->image_avatar;
                                if (!\Str::contains($avt, 'http')) {
                                    $avt = \Storage::url($avt);
                                }
                            @endphp
                            <div class="product-item">
                                <div class="single-product">
                                    <div class="product-img">
                                        <a href="{{ route('shop.productDetail', $product->slug) }}">
                                            <img class="primary-img" src="{{ $avt }}"
                                                alt="Kenne's Product Image">
                                        </a>
                                        {!! $product->discount_percent > 0 ? "<span class='sticker'>- $product->discount_percent%</span>" : '' !!}
                                        <div class="add-actions">
                                            <ul>
                                                <li>
                                                    <a href="{{ route('shop.productDetail', $product->slug) }}"
                                                        data-bs-toggle="tooltip" data-placement="right"
                                                        title="Xem nhanh sản phẩm">
                                                        <i class="ion-ios-search"></i>
                                                    </a>
                                                </li>
                                                <li><a href="wishlist.html" data-bs-toggle="tooltip"
                                                        data-placement="right" title="Thêm vào danh sách yêu thích"><i
                                                            class="ion-ios-heart-outline"></i></a>
                                                </li>
                                                <li><a href="compare.html" data-bs-toggle="tooltip"
                                                        data-placement="right" title="So sánh sản phẩm"><i
                                                            class="ion-ios-reload"></i></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product-content">
                                        <div class="product-desc_info">
                                            <h3 class="product-name">
                                                <a
                                                    href="{{ route('shop.productDetail', $product->slug) }}">{{ $product->name }}</a>
                                            </h3>
                                            <div class="price-box">
                                                <span class="new-price">
                                                    {{ number_format((int) ($product->discount_percent > 0 ? $product->price_regular * (1 - $product->discount_percent / 100) : ($product->price_sale > 0 ? $product->price_sale : $product->price_regular)), 0, ',', '.') }}
                                                    (VND)
                                                </span>
                                                @if ($product->discount_percent > 0 || $product->price_sale > 0)
                                                    <span class="old-price">
                                                        {{ number_format((int) $product->price_regular, 0, ',', '.') }}
                                                    </span>
                                                @endif
                                            </div>
                                            {{-- <div class="rating-box">
                                                <ul>
                                                    <li><i class="ion-ios-star"></i></li>
                                                    <li><i class="ion-ios-star"></i></li>
                                                    <li><i class="ion-ios-star"></i></li>
                                                    <li class="silver-color"><i class="ion-ios-star-half"></i></li>
                                                    <li class="silver-color">
                                                        <i class="ion-ios-star-outline"></i>
                                                    </li>
                                                </ul>
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Product Area End Here -->

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
        .single-line {
            white-space: nowrap;
            /* Không cho phép xuống dòng */
            overflow: hidden;
            /* Ẩn phần văn bản tràn ra ngoài */
            text-overflow: ellipsis;
            /* Hiển thị dấu ba chấm (...) */
        }

        .pagination {
            --bs-pagination-active-bg: #a8741a;
            --bs-pagination-active-border-color: #a8741a;
        }

        button.add-to_cart {
            background-color: #a8741a;
            border: 2px solid #a8741a;
            color: #ffffff;
            width: 140px;
            height: 50px;
            line-height: 47px;
        }

        button.add-to_cart:hover {
            background-color: #242424;
            border: none;
        }

        /* style input radio */
        .color-list {
            display: flex;
            gap: 5px;
        }

        .single-color-input {
            display: none;
        }

        .single-color {
            display: inline-flex;
            align-items: center;
            border: 2px solid transparent;
            padding: 5px;
            cursor: pointer;
        }

        .single-color-input:checked+.single-color {
            border-color: gold;
            /* Màu viền khi chọn */
        }
    </style>
@endsection
@section('js-setting')
    <script>
        // ajax rend color
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            // rend màu biến thể sản phẩm ========================================================
            function handleSelectionChange() {
                var selectedSize = $('select[name="id_size"]#id_size').val();
                var selectedPrdID = {{ $data->id }};

                if (selectedSize > 0 && selectedPrdID > 0) {
                    sendAjaxRequest(selectedPrdID, selectedSize);
                }
            }
            $('select[name="id_size"]#id_size').change(handleSelectionChange);

            function sendAjaxRequest(selectedPrdID, selectedSize) {
                $.ajax({
                    url: '{{ route('shop.rend_variant') }}',
                    type: 'POST',
                    data: {
                        prd_id: selectedPrdID,
                        idSize: selectedSize
                    },
                    success: function(res) {
                        if (res.error) {
                            alert(res.error);
                        } else {
                            var rendColor = document.querySelector('div#color-list.color-list');
                            if (rendColor) {
                                $(rendColor).empty();
                                res.data.forEach(item => {
                                    $(rendColor).append(`
                                    <input type="radio" id="color-${item.id}" name="product-color"
                                        value="${item.id}" class="single-color-input">
                                    <label for="color-${item.id}" class="single-color">
                                        <span class=""
                                            style="background-color: ${item.color_value}; width: 20px; height: 20px; display: inline-block;"></span>
                                        <span class="color-text">Mã màu: ${item.color_value}</span>
                                    </label>
                                    `);
                                });
                            }
                        }
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                        alert('Vui lòng chọn giá trị hợp lệ!');
                    }
                });
            }
            // ren thông tin sản phẩm biến thể ======================================================
            $(document).on('change', 'input[name="product-color"]', function() {
                var selectedSize = $('select[name="id_size"]#id_size').val();
                var selectedColor = $(this).val();
                var selectedPrdID = {{ $data->id }};
                // Bạn có thể xử lý giá trị selectedColorValue ở đây
                if (selectedColor > 0 && selectedSize > 0 && selectedPrdID > 0) {
                    sendRequestVariant(selectedPrdID, selectedSize, selectedColor);
                }
            });

            function sendRequestVariant(selectedPrdID, selectedSize, selectedColor) {
                $.ajax({
                    url: '{{ route('shop.rendPrdV') }}',
                    type: 'POST',
                    data: {
                        prd_id: selectedPrdID,
                        idSize: selectedSize,
                        idColor: selectedColor
                    },
                    success: function(response) {
                        updateHiddenInput('idVariant', response.id);
                        updateHiddenInput('colorValue', response.color_value);
                        updateHiddenInput('sizeValue', response.size_value);

                        var formatPrice = price => price.toString().replace(/\B(?=(\d{3})+(?!\d))/g,
                            ".");
                        var price_default = formatPrice(response.price_default != null ? response
                            .price_default : {{ $data->price_regular }});
                        var price_sale = formatPrice(response.price_sale != null ? response
                            .price_sale :
                            {{ $data->price_sale > 0 ? $data->price_sale : 0 }});
                        var quantity = response.quantity != null ? response.quantity : 0;
                        var htmlPD = '';
                        var htmlPS = '';
                        var htmlPQ = `<li>Số lượng: <a href="javascript:void(0)">${quantity}</a></li>`;
                        var htmlPST =
                            `<li>Tình trạng: <a href="javascript:void(0)">${quantity < 5 && quantity > 0 ? 'Sắp hết hàng' : (quantity == 0 ? 'Hết hàng' : 'Còn hàng')}</a></li>`;
                        if (response.price_sale > 0) {
                            htmlPS =
                                `<li>Giá khuyến mại: <a href="javascript:void(0)"><strong>${price_sale} (VNĐ)</strong></a></li>`;
                            htmlPD =
                                `<li>Giá mặc định: <a href="javascript:void(0)"><strike>${price_default} (VNĐ)</strike></a></li>`;
                        } else {
                            htmlPD =
                                `<li>Giá mặc định: <a href="javascript:void(0)"><strong>${price_default} (VNĐ)</strong></a></li>`;
                        }
                        $('ul.load-infor#load-infor').empty().append(htmlPQ, htmlPST, htmlPD, htmlPS);

                        $('div.mt-3.loadQuantity').empty().append(
                            `<h6>Số lượng tồn kho: ${quantity}</h6>`);
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                        alert('Vui lòng chọn giá trị hợp lệ!');
                    }
                });
            }

            function updateHiddenInput(name, value) {
                var input = document.querySelector(`input[type="hidden"][name="${name}"]`);
                if (input) {
                    input.value = value; // Nếu input đã tồn tại, cập nhật giá trị
                } else {
                    input = document.createElement('input'); // Tạo thẻ input mới
                    input.type = 'hidden';
                    input.name = name;
                    input.value = value;
                    document.querySelector('form.sp-content').appendChild(input); // Thêm vào form
                }
            }
        });
        // Gán sự kiện sử dụng event delegation
        document.querySelector('div#color-list.color-list').addEventListener('change', function(e) {
            if (e.target.classList.contains('single-color-input')) {
                // Bỏ class 'active' khỏi tất cả các label
                document.querySelectorAll('.single-color').forEach(label => {
                    label.classList.remove('active');
                });
                // Thêm class 'active' cho label tương ứng với input được chọn
                const label = e.target.nextElementSibling;
                label.classList.add('active');
            }
        });
    </script>

    <script>
        $(document).ready(
            function() {
                $('.add-to-wishlist').click(function(e) {
                    e.preventDefault();
                    let productId = $(this).data('product-id');
                    let productSize = $('#id_size').val();
                    let productColor = $('input[name="product-color"]:checked').val();
                    $.ajax({
                        url: '{{ route('wishlist.add') }}',
                        method: 'POST',
                        data: {
                            product_id: productId,
                            size_attribute_id: productSize,
                            color_attribute_id: productColor,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            alert(response.message);

                        },
                        error: function(error, response) {
                            alert(response.message);
                            console.error(error);
                        }
                    });
                })
            });
    </script>
@endsection
