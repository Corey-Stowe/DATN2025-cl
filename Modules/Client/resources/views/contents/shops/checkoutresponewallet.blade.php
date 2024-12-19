@extends('client::layouts.master')

@section('title')
    Chi tiết thanh toán | Thời trang Phong cách Việt
@endsection
@section('css-setting')
    <link href="{{ Module::asset('wallet:css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <?php
      Use PhpOffice\PhpSpreadsheet\Style\NumberFormat\NumberFormatter;
    ?>
@endsection
@section('contents')
    <!-- Begin Kenne's Breadcrumb Area -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="breadcrumb-content">
                <h2 style="margin-top: 30px;">Thời trang Phong cách Việt</h2>
                <ul>
                    <li><a href="{{ route('index') }}">Trang chủ</a></li>
                    <li class="active">Chi tiết thanh toán</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Kenne's Breadcrumb Area End Here -->

    <!-- Begin Kenne's Content Wrapper Area -->
    <div class="kenne-content_wrapper">
        <div class="container">
            <div class="container">
                @if ($returndata['status'] == "success")
                    <div class="d-flex justify-content-center">
                        <i class="bx bx-check-circle text-success" style="font-size: 150px;"></i>
                    </div>

                    <div class="d-flex justify-content-center">
                        <div class="text-center">
                            <h3 class="mt-3">Thanh toán thành công</h3>
                            <p class="text-muted">Cảm ơn bạn đã mua hàng với chúng tôi</p>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center mt-2">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title text-center">Thông tin giao dịch</h3>
                                {{-- <p class="card-text ">Mã giao dịch: <strong>{{ $returndata['order_id'] }}</strong></p> --}}
                                <p class="card-text">Số tiền: <strong>{{ number_format($returndata['ammount'] ) }}
                                        VND</strong>
                                </p>
                                <p class="card-text">Phương thức thanh toán:
                                    <strong>Ví tiền điện tử</strong>
                                </p>
                            </div>
                        </div>
                    </div>
                @endif

                @if ($returndata['status'] != 'success')
                    <div class="d-flex justify-content-center">
                        <i class="bx bx-x-circle text-danger" style="font-size: 150px;"></i>
                    </div>
                    <div class="d-flex justify-content-center">
                        <div class="text-center">
                            <h3 class="mt-3">Thanh toán thất bại </h3>
                                <p class="text-muted">Giao dịch đã bị hủy bởi người dùng</p>
                            </p>
                            <button class="btn kenne-login_btn"
                                onclick="window.location.href='{{ route('cart.checkout') }}'">Quay
                                lại</button>

                        </div>
                    </div>
                @endif

                {{-- <div class="d-flex justify-content-center mt-2">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title text-center">Thông tin giao dịch</h3>
                            <p class="card-text ">Mã giao dịch: <strong>{{ $returndata['vnp_TxnRef'] }}</strong></p>
                            <p class="card-text">Mã tham chiếu: <strong>{{ $returndata['vnp_BankTranNo'] }}</strong></p>
                            <p class="card-text">Số tiền: <strong>{{ number_format($returndata['Ammout'] / 100) }}
                                    VND</strong></p>
                            <p class="card-text">Phương thức thanh toán: <strong>{{ $returndata['vnp_CardType'] }}</strong>
                            </p>
                            <p class="card-text">Ngày khởi tạo: <strong>{{ $returndata['vnp_PayDate'] }}</strong></p>
                            <p class="card-text text-muted">Request ID:
                                <strong>{{ $returndata['vnp_SecureHash'] }}</strong>
                            </p>
                        </div>
                    </div>
                </div> --}}
            </div>

            <div class="row mb-3">

            </div>
            <div class="row mb-3">

            </div>
            @if ($returndata['status'] == "success")
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-content table-responsive">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>STT</th>
                                                <th>Hình ảnh</th>
                                                <th>Tên sản phẩm</th>
                                                <th>Giá</th>
                                                <th>Số lượng</th>
                                                <th>Thành tiền</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($orderItems as $key => $orderDetail)
                                                <tr>
                                                    <td class="product-name">{{ $key + 1 }}</td>
                                                    <td class="product-thumbnail">
                                                        <a
                                                            href="{{ route('shop.productDetail', $orderDetail->productVariant->product->slug) }}"><img
                                                                src="{{ asset($orderDetail->productVariant->product->product_avata) }}"
                                                                alt="Kenne"></a>
                                                    </td>
                                                    <td class="product-name"><a
                                                            href="{{ route('shop.productDetail', $orderDetail->productVariant->product->slug) }}">{{ $orderDetail->productVariant->product->name }}</a>
                                                        - Size: {{ $orderDetail->productVariant->size->size_value }}
                                                        <br>
                                                        - Màu: <input type="color"
                                                            value="{{ $orderDetail->productVariant->color->color_value }}"
                                                            disabled>
                                                    </td>
                                                    <td class="product-price-cart"><span
                                                            class="amount">{{ number_format($orderDetail->product_price_final) }}
                                                            VND</span></td>
                                                    <td class="product-quantity">
                                                        {{ $orderDetail->product_quantity }}
                                                    </td>
                                                    <td class="product-subtotal">
                                                        {{ number_format($orderDetail->product_price_final * $orderDetail->product_quantity) }}
                                                        VND</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5 ml-auto">
                        <div class="cart-page-total">
                            <h2>Tổng</h2>
                            <ul>
                                <li>Tổng <span>{{ number_format($order->discount + $order->total_price) }} VND</span></li>
                                <li>Giảm Giá <span>{{ number_format($order->discount) }} VND</span></li>
                                <li>Thành tiền <span>{{ number_format($order->total_price) }} VND</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            @endif



        </div>
    </div>
    <!-- Kenne's Content Wrapper Area End Here -->
@endsection
@section('js-setting')
@endsection
