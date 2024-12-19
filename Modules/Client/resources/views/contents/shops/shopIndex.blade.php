@extends('client::layouts.master')

@section('title')
    Cửa hàng | Thời trang Phong cách Việt
@endsection
@section('contents')
    <!-- Begin Kenne's Breadcrumb Area -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="breadcrumb-content">
                <h2 style="margin-top: 30px;">Thời trang Phong cách Việt</h2>
                <ul>
                    <li><a href="{{ route('index') }}">Trang chủ</a></li>
                    <li class="active">Cửa hàng</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Kenne's Breadcrumb Area End Here -->

    <!-- Begin Kenne's Content Wrapper Area -->
    <div class="kenne-content_wrapper">
        <div class="container">
            <div class="row">
                {{-- sidebar --}}
                <div class="col-xl-3 col-lg-4 order-2 order-lg-1">
                    <form method="GET" action="{{ route('filterproduct') }}">
                        <div class="kenne-sidebar-catagories_area">
                            <div class="kenne-sidebar_categories">
                                <div class="kenne-categories_title first-child">
                                    <h5>Lọc theo giá</h5>
                                </div>
                                <div class="price-filter">
                                    <div class="price-slider-amount">
                                        <div class="label-input">
                                            <label for="min-price">Từ: </label>
                                            <input type="number" id="min-price" name="min_price" placeholder="Giá thấp nhất" value="{{ request('min_price') }}" />

                                            <label for="max-price">Đến: </label>
                                            <input type="number" id="max-price" name="max_price" placeholder="Giá cao nhất" value="{{ request('max_price') }}" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="kenne-sidebar_categories category-module">
                                <div class="kenne-categories_title">
                                    <h5>Danh mục sản phẩm</h5>
                                </div>
                                <div class="sidebar-categories_menu">
                                    <ul>
                                        @foreach ($categories as $item)
                                            <li class="has-sub">
                                                <a href="javascript:void(0)">{{ $item->name }} <i
                                                        class="ion-ios-plus-empty"></i></a>
                                                @if (count($item->sub_category) > 0)
                                                    <ul>
                                                        @foreach ($item->sub_category as $sub)
                                                        <li>
                                                            <input type="checkbox" id="category-{{ $item->id }}" name="sub_categories[]" value="{{ $sub->id }}"
                                                                {{ in_array($sub->id, request('categories', [])) ? 'checked' : '' }}>
                                                            <label for="category-{{ $sub->id }}">{{ $sub->name }}</label>
                                                        </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            {{-- <div class="kenne-sidebar_categories category-module">
                                <div class="kenne-categories_title">
                                    <h5>Danh mục sản phẩm</h5>
                                </div>
                                <div class="sidebar-categories_menu">
                                    <ul>
                                        @foreach ($categories as $item)
                                            <li>
                                                <input type="checkbox" id="category-{{ $item->id }}" name="categories[]" value="{{ $item->id }}"
                                                    {{ in_array($item->id, request('categories', [])) ? 'checked' : '' }}>
                                                <label for="category-{{ $item->id }}">{{ $item->name }}</label>
                                            </li>
                                        @endforeach

                                    </ul>
                                </div>
                            </div> --}}
                            <div class="kenne-sidebar_categories">
                                <div class="kenne-categories_title">
                                    <h5>Màu sắc</h5>
                                </div>
                                <ul class="sidebar-checkbox_list">
                                    @foreach ($colors as $c)
                                        @php
                                            $textColor = getContrastingColor($c->color_value);
                                        @endphp
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="{{ $c->id }}"
                                                id="flexCheckDefault" name="color[]">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                <span class="badge"
                                                    style="background-color: {{ $c->color_value }}; color: {{ $textColor }};">{{ $c->color_value }}</span>
                                            </label>
                                        </div>
                                    @endforeach
                                    @php
                                        function getContrastingColor($hexColor)
                                        {
                                            // Chuyển mã màu hex thành RGB
                                            $r = hexdec(substr($hexColor, 1, 2));
                                            $g = hexdec(substr($hexColor, 3, 2));
                                            $b = hexdec(substr($hexColor, 5, 2));

                                            // Tính toán độ sáng của màu
                                            $brightness = ($r * 299 + $g * 587 + $b * 114) / 1000;

                                            // Nếu độ sáng lớn hơn 128, trả về màu đen, ngược lại là màu trắng
                                            return $brightness > 128 ? '#000000' : '#FFFFFF';
                                        }

                                    @endphp
                                </ul>
                            </div>
                            <div class="kenne-sidebar_categories">
                                <div class="kenne-categories_title">
                                    <h5>Kích thước</h5>
                                </div>
                                <ul class="sidebar-checkbox_list">
                                    @foreach ($sizes as $s)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="{{ $s->id }}" id="size-{{ $s->id }}" name="sizes[]"
                                                {{ in_array($s->id, request('sizes', [])) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="size-{{ $s->id }}">{{ $s->size_value }}</label>
                                        </div>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="kenne-sidebar_categories">
                                <div class="kenne-categories_title kenne-tags_title">
                                    <h5>Thẻ</h5>

                                </div>

                                <ul class="kenne-tags_list">
                                    @foreach ($tags as $item)
                                        <li>
                                            <input type="checkbox" id="tag-{{ $item->id }}" name="tags[]" value="{{ $item->name }}"
                                                {{ in_array($item->id, request('tags', [])) ? 'checked' : '' }}>
                                            <label for="tag-{{ $item->id }}">{{ $item->name }}</label>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                </div>
                <div class="col-xl-9 col-lg-8 order-1 order-lg-2">
                    <div class="shop-toolbar">
                        <div class="product-view-mode">
                            <a class="active grid-3" data-target="gridview-3" data-toggle="tooltip" data-placement="top"
                                title="Xem theo cột">
                                <i class="fa fa-th"></i>
                            </a>
                            <a class="list" data-target="listview" data-toggle="tooltip" data-placement="top"
                                title="Xem theo danh sách">
                                <i class="fa fa-th-list"></i>
                            </a>
                        </div>
                        {{-- {{-- <div class="product-item-selection_area">
                            <div class="product-short">
                                <label class="select-label">Sắp xếp theo:</label>
                                <select class="nice-select myniceselect" name="short">
                                    <option value="1">Mặc định</option>
                                    <option value="name_asc">Tên, A đến Z</option>
                                    <option value="name_desc">Tên, Z đến A</option>
                                    <option value="price_asc">Giá, từ thấp đến cao</option>
                                    <option value="price_desc">Giá, từ cao đến thấp</option>
                                </select>
                            </div>
                        </div> --}}
                        <button type="submit" class=" kenne-btn filter-btn">Áp dụng bộ lọc</button>
                    </div>
                </form>
                    <div class="shop-product-wrap grid gridview-3 row">
                        @foreach ($data as $product)
                            @php
                                $avt = $product->image_avatar;
                                if (!\Str::contains($avt, 'http')) {
                                    $avt = \Storage::url($avt);
                                }
                            @endphp
                            <div class="col-lg-4 col-md-4 col-sm-6">
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
                                                        <a href="{{ route('shop.productDetail', $product->slug) }}" data-bs-toggle="tooltip"
                                                            data-placement="right" title="Xem nhanh sản phẩm">
                                                            <i class="ion-ios-search"></i>
                                                        </a>
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
                                <div class="list-product_item">
                                    <div class="single-product">
                                        <div class="product-img">
                                            <a href="{{ route('shop.productDetail', $product->slug) }}">
                                                <img src="{{ $avt }}" alt="Kenne's Product Image">
                                            </a>
                                        </div>
                                        <div class="product-content">
                                            <div class="product-desc_info">
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
                                                <h6 class="product-name">
                                                    <a
                                                        href="{{ route('shop.productDetail', $product->slug) }}">{{ $product->name }}</a>
                                                </h6>
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
                                                <div class="product-short_desc">
                                                    {!! $product->description !!}
                                                </div>
                                            </div>
                                            <div class="add-actions">
                                                <ul>
                                                    <li>
                                                        <a href="{{ route('shop.productDetail', $product->slug) }}" data-bs-toggle="tooltip"
                                                            data-placement="right" title="Xem nhanh sản phẩm">
                                                            <i class="ion-ios-search"></i>
                                                        </a>
                                                    </li>
                                                    {{-- <li><a href="wishlist.html" data-bs-toggle="tooltip"
                                                            data-placement="right" title="Thêm vào danh sách yêu thích"><i
                                                                class="ion-ios-heart-outline"></i></a>
                                                    </li>
                                                    <li><a href="compare.html" data-bs-toggle="tooltip"
                                                            data-placement="right" title="So sánh sản phẩm"><i
                                                                class="ion-ios-reload"></i></a>
                                                    </li> --}}
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    {{-- pagination --}}
                    <div class="row mt-3">
                        <div class="col-lg-12">
                            {{ $data->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

    <!-- Kenne's Content Wrapper Area End Here -->

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
                                    <img src="{{ 'theme/client/images/brand/1.png' }}" alt="Brand Images">
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
            background-color: #242424;
            border: 2px solid #242424;
            color: #ffffff;
            width: 140px;
            height: 50px;
            line-height: 47px;
        }

        button.add-to_cart:hover {
            background-color: #a8741a;
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
        document.querySelectorAll('.single-color-input').forEach(input => {
            input.addEventListener('change', function() {
                document.querySelectorAll('.single-color').forEach(label => {
                    label.classList.remove('active');
                });
                this.nextElementSibling.classList.add('active');
            });
        });
    </script>
@endsection
