<!-- Begin Product Area -->
<div class="product-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h3>Sản phẩm mới</h3>
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
                    @foreach ($products_new as $product)
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
                                        <img class="primary-img" src="{{ $avt }}" alt="Kenne's Product Image" style="max-height: 300px; object-fit: cover;">
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
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Product Area End Here -->
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
