@extends('client::layouts.master')

@section('title')
    Yêu thích | Thời trang Phong cách Việt
@endsection
@section('css-setting')
@endsection
@section('contents')
    <div class="breadcrumb-area">
        <div class="container">
            <div class="breadcrumb-content">
                <h2>Thời trang Phong cách Việt</h2>
                <ul>
                    <li><a href="{{ route('index') }}">Trang Chủ</a></li>
                    <li class="active">Yêu thích</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="kenne-wishlist_area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <form action="javascript:void(0)">
                        <div class="table-content table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="kenne-product_remove">Xóa</th>
                                        <th class="kenne-product-thumbnail">Ảnh</th>
                                        <th class="cart-product-name">Sản phẩm</th>
                                        <th class="kenne-product-price">Giá</th>
                                        <th class="kenne-product-stock-status">Trạng thái</th>
                                        <th class="kenne-cart_btn">Hàng động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($data) > 0)
                                        @foreach ($data as $item)
                                            <tr data-id="{{ $item->id }}">
                                                <td class="kenne-product_remove">
                                                    <a href="#" class="btn-delete"><i class="fa fa-trash"
                                                            title="Remove"></i></a>
                                                </td>
                                                @php
                                                    $url = $item->product->image_avatar;
                                                    if (!\Str::contains($url, 'http')) {
                                                        $url = \Storage::url($url);
                                                    }
                                                @endphp
                                                <td class="kenne-product-thumbnail"><a
                                                        href="{{ route('shop.productDetail', $item->product->slug) }}">
                                                        <img src="{{ $url }}" width="200"
                                                            alt="{{ $item->product->slug }}"></a>
                                                </td>
                                                <td class="kenne-product-name">
                                                    <a
                                                        href="{{ route('shop.productDetail', $item->product->slug) }}">{{ $item->product->name }}</a>
                                                    - Size: {{ $item->productVariant->size->size_value }}
                                                    <br>
                                                    - Màu: <input type="color"
                                                        value="{{ $item->productVariant->color->color_value }}" disabled>
                                                </td>
                                                <td class="kenne-product-price">
                                                    @php
                                                        $price = 0;
                                                        $productVariant = App\Models\ProductVariant::find(
                                                            $item->productVariant->id,
                                                        );
                                                        if ($productVariant) {
                                                            $current_date = now();
                                                            $price_sale = $productVariant->price_sale;
                                                            $start_date = $productVariant->start_date;
                                                            $end_date = $productVariant->end_date;
                                                            $price_default = $productVariant->price_default;
                                                            if (
                                                                $price_sale !== null &&
                                                                $start_date !== null &&
                                                                $end_date !== null
                                                            ) {
                                                                // Kiểm tra xem thời gian hiện tại có nằm trong khoảng thời gian khuyến mãi không
                                                                if (
                                                                    $current_date >= $start_date &&
                                                                    $current_date <= $end_date
                                                                ) {
                                                                    $price = $price_sale; // Trong khoảng thời gian khuyến mãi
                                                                } else {
                                                                    $price = $price_default; // Không trong khoảng thời gian khuyến mãi
                                                                }
                                                            } elseif (
                                                                $price_sale !== null &&
                                                                $start_date === null &&
                                                                $end_date === null
                                                            ) {
                                                                $price = $price_sale; // Không có thời gian, chỉ có giá khuyến mãi
                                                            } elseif (
                                                                $price_sale === null &&
                                                                $start_date === null &&
                                                                $end_date === null
                                                            ) {
                                                                $price = $price_default; // Không có giá khuyến mãi, trả về giá mặc định
                                                            }

                                                            if (
                                                                $price_sale === 0 &&
                                                                $price_default === 0 &&
                                                                $start_date === null &&
                                                                $end_date === null
                                                            ) {
                                                                $product = App\Models\Product::find($item->product->id);
                                                                $current_date = now();
                                                                $product_price_sale = $product->price_sale;
                                                                $product_start_date = $product->start_date;
                                                                $product_end_date = $product->end_date;
                                                                $product_price_default = $product->price_regular;

                                                                if (
                                                                    $product_price_sale !== null &&
                                                                    $product_start_date !== null &&
                                                                    $product_end_date !== null
                                                                ) {
                                                                    // Kiểm tra xem thời gian hiện tại có nằm trong khoảng thời gian khuyến mãi không
                                                                    if (
                                                                        $current_date >= $product_start_date &&
                                                                        $current_date <= $product_end_date
                                                                    ) {
                                                                        $price = $product_price_sale; // Trong khoảng thời gian khuyến mãi
                                                                    } else {
                                                                        $price = $product_price_default; // Không trong khoảng thời gian khuyến mãi
                                                                    }
                                                                } elseif (
                                                                    $product_price_sale !== null &&
                                                                    $product_start_date === null &&
                                                                    $product_end_date === null
                                                                ) {
                                                                    $price = $product_price_sale; // Không có thời gian, chỉ có giá khuyến mãi
                                                                } elseif (
                                                                    $product_price_sale === null &&
                                                                    $product_start_date === null &&
                                                                    $product_end_date === null
                                                                ) {
                                                                    $price = $product_price_default; // Không có giá khuyến mãi, trả về giá mặc định
                                                                }
                                                            }
                                                        }
                                                    @endphp
                                                    <span class="amount">{{ number_format($price, 0, ',', '.') }}
                                                        VND</span>
                                                </td>
                                                <td class="kenne-product-stock-status">
                                                    <span
                                                        @if ($item->product->quantity > 0) class="in-stock "
                                                        @else
                                                            class="out-stock" @endif>
                                                        @if ($item->product->quantity > 0)
                                                            Còn hàng
                                                        @else
                                                            Hết hàng
                                                        @endif
                                                    </span>
                                                </td>
                                                <td class="kenne-cart_btn"><a href="$"
                                                        class="add-to-cart-wishlist add-to-cart-wishlist-delete"
                                                        data-color-id="{{ $item->productVariant->color->id }}"
                                                        data-size-id="{{ $item->productVariant->size->id }}"
                                                        data-product-id="{{ $item->product->id }}">Thêm vào giỏ hàng</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <div class="rating-box">
                                            <span class="reference text-warning">Hiện tại chưa có sản phẩm yêu thích
                                                nào!</span>
                                        </div>
                                    @endif

                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js-setting')
    <script>
        $(document).ready(function() {
            $('.btn-delete').click(function() {
                var tr = $(this).closest('tr');
                $.ajax({
                    url: "{{ route('wishlist.index') }}/remove/" + tr.data('id'),
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        _method: 'DELETE',
                        id: tr.data('id')
                    },
                    success: function(response) {
                        if (response.success) {
                            alert(response.message);
                            tr.remove();
                        } else {
                            alert(response.message);
                        }
                    }
                });
            });

            $('.add-to-cart-wishlist-delete').click(function() {
                var tr = $(this).closest('tr');
                $.ajax({
                    url: "{{ route('wishlist.index') }}/remove/" + tr.data('id'),
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        _method: 'DELETE',
                        id: tr.data('id')
                    },
                    success: function(response) {
                        if (response.success) {
                            tr.remove();
                        } else {
                            console.log(response.message);
                        }
                    }
                });
            });
        });
    </script>
@endsection
