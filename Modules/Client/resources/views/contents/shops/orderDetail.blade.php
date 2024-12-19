@extends('client::layouts.master')

@section('title')
    Chi tiết hóa đơn | Thời trang Phong cách Việt
@endsection
@section('css-setting')
    <link href="{{ Module::asset('wallet:css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <script src="{{ asset('dataTables/datatables.js') }}"></script>
    <script src="{{ asset('sweetalert2/sweetalert2.all.min.js') }}"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
@endsection
@section('contents')
    <!-- Begin Kenne's Breadcrumb Area -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="breadcrumb-content">
                <h2 style="margin-top: 30px;">Thời trang Phong cách Việt</h2>
                <ul>
                    <li><a href="{{ route('index') }}">Trang chủ</a></li>
                    <li class="active">Chi tiết Hóa đơn</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Kenne's Breadcrumb Area End Here -->

    <!-- Begin Kenne's Content Wrapper Area -->
    <div class="kenne-content_wrapper">
        <div class="container">
            <div class="row mb-3">
                <div class="col-md-12">
                    <h2 style="text-align: center"> Chi tiết hóa đơn #{{ $order->id }} </h2>
                </div>
            </div>

            <div class="row mb-3">

            </div>

            <div class="row mb-3">

                <div class="col-md-6">
                    <strong>Người nhận:</strong> {{ $order->ship_user_name }}<br>
                    <strong>Email:</strong> {{ $order->ship_user_email }}<br>
                    <strong>Điện thoại:</strong> {{ $order->ship_user_phone }}<br>
                    <strong>Nơi nhận:</strong> {{ $order->ship_user_address }}
                </div>
                <div class="col-md-6">
                    <strong>Phương thức thanh toán:</strong> {{ $order->payment_method }}<br>
                    <strong>Ngày Tạo:</strong>
                    {{ \Carbon\Carbon::parse($order->date_create_order)->format('H:i d/m/Y') }}<br>
                    <strong>Trạng thái thanh toán: </strong>{{ $order->status_payment }} <br>
                    <strong>Trạng thái đơn hàng: </strong>{{ $order->status_order }} <br>
                </div>

            </div>

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
                                                    @php
                                                        $url = $orderDetail->product_avatar;
                                                        if (!\Str::contains($url, 'http')) {
                                                            $url = \Storage::url($url);
                                                        }
                                                    @endphp
                                                    <a
                                                        href="{{ route('shop.productDetail', $orderDetail->productVariant->product->slug) }}"><img
                                                            src="{{ $url }}" width="150" alt="Kenne"></a>
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
            <div class="row mb-3">
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

            <div class="row mb-3">
                @if ($order->status_order == 'Đang giao hàng' && isset($frist_location))
                    <div class="card-header">
                        <h4 class="text-center mt-3">Trạng thái giao hàng</h3>
                    </div>
                    <div class="card-body">
                        <!-- Card lồng -->

                        <!-- Bản đồ -->
                        <div class="table-responsive fs-10 mb-3">
                            <div id="map" style="height: 500px; width: 100%;"></div>
                        </div>
                        <!-- Lịch sử giao hàng -->
                        <div class="mt-2">
                            <h5 class="text-center">Lịch sử giao hàng</h5>
                            <div class="card">
                                <div class="card-body">
                                    @foreach ($data_ship as $ship)
                                        <ul class="mb-1">
                                            <li>
                                                {{ $ship->updated_at }} - {{ $ship->status }}
                                            </li>
                                        </ul>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                     @endif
            </div>
            <script>
                @if (isset($frist_location) )
            document.addEventListener("DOMContentLoaded", function() {
                // Lấy dữ liệu từ Blade
                const firstLocation = {
                    latitude: {{ $frist_location->latitude }},
                    longitude: {{ $frist_location->longitude }}
                };
                const lastLocation = {
                    latitude: {{ $last_location->latitude }},
                    longitude: {{ $last_location->longitude }},
                };

                const routeCoordinates = @json($data_ship->map(fn($item) => ['latitude' => $item->latitude, 'longitude' => $item->longitude]));

                // Khởi tạo bản đồ
                map = L.map('map').setView([firstLocation.latitude, firstLocation.longitude], 13);

                // Thêm tile layer
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 19,
                }).addTo(map);

                // Tạo marker ban đầu
                deliveryMarker = L.marker([lastLocation.latitude, lastLocation.longitude]) // Gán vào biến toàn cục
                    .addTo(map)
                    .bindPopup("{{ $last_location->status }}")
                    .openPopup();

                // Thêm tuyến ship
                const coordinates = routeCoordinates.map(coord => [coord.latitude, coord.longitude]);
                const route = L.polyline(coordinates, {
                    color: 'blue',
                    weight: 5,
                    opacity: 0.7
                }).addTo(map);

                // Fit bản đồ theo tuyến
                map.fitBounds(route.getBounds());
            });
        @endif
                </script>

            <div class="row mb-5 mt-3">
                <h3>Thao tác</h3>
                <div class="col-md-3 mb-3">
                    <a href="{{ route('orders.downloadPDF', ['id' => $order->id]) }}" class="kenne-btn kenne-btn_sm">In hóa
                        đơn</a>
                </div>
                <div class="col-md-3 mb-4">
                    @if ($order->status_order == 'Chờ xác nhận' || $order->status_order == 'Đã xác nhận')
                        <button class="kenne-btn kenne-btn_sm" onclick="cancelOrder({{ $order->id }})">Hủy đơn
                            hàng</button>
                    @endif

                    {{-- @if ($order->status_order == 'Đơn hàng bị hủy')
                        <button class="kenne-btn kenne-btn_sm" onclick="resetOrder({{ $order->id }})">Đặt lại đơn
                            hàng</button>
                    @endif --}}

                    @if ($order->status_order == 'Đang giao hàng')
                        <button class="kenne-btn kenne-btn_sm" onclick="markOrderAsReceived({{ $order->id }})">Đã nhận
                            hàng</button>
                    @endif
                </div>
                <div class="col-md-3 mb-3">
                    @if ($order->status_payment == 'Chưa thanh toán' && $order->payment_method !== 'Thanh toán khi nhận hàng')
                    <a class="kenne-btn kenne-btn_sm" href="{{ route('retrypayment', ['id' => $order->id]) }}">Tiếp tục thanh toán đơn hàng</a>
                    @endif
                </div>
                <div class="col-md-3 mb-3">

                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            // Kiểm tra xem có query parameter 'email' không
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.get('email') === 'true') {
                const id = {{ $order->id }};

                $.ajax({
                    url: '{{ route('send.notification') }}',
                    method: 'POST',
                    data: {
                        id: id,
                        _token: '{{ csrf_token() }}' // CSRF token
                    },
                    success: function(response) {
                        console.log('Notification sent successfully.');
                    },
                    error: function(xhr) {
                        console.error('Error sending notification:', xhr);
                    }
                });
            }
        });
    </script>
    <!-- Kenne's Content Wrapper Area End Here -->
@endsection
@section('js-setting')
    <script>
        function cancelOrder(orderId) {
            Swal.fire({
                title: 'Bạn có chắc chắn muốn hủy đơn hàng?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Hủy đơn hàng',
                cancelButtonText: 'Hủy bỏ',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/orders/' + orderId + '/cancel',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {

                            location.reload(); // Tải lại trang để cập nhật trạng thái
                            Swal.fire('Thành công!', response.message, 'success');

                        },
                        error: function(xhr) {
                            Swal.fire('Lỗi!', xhr.responseJSON.message, 'error');
                        }
                    });
                }
            });
        }

        function resetOrder(orderId) {
            Swal.fire({
                title: 'Bạn có chắc chắn muốn đặt lại đơn hàng?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Đặt lại đơn hàng',
                cancelButtonText: 'Hủy bỏ',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/orders/' + orderId + '/reset',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            location.reload(); // Tải lại trang để cập nhật trạng thái
                            Swal.fire('Thành công!', response.message, 'success');


                        },
                        error: function(xhr) {
                            Swal.fire('Lỗi!', xhr.responseJSON.message, 'error');
                        }
                    });
                }
            });
        }

        function markOrderAsReceived(orderId) {
            Swal.fire({
                title: 'Bạn có chắc chắn đã nhận hàng?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Đã nhận',
                cancelButtonText: 'Hủy bỏ'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/orders/' + orderId + '/received',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            location.reload(); // Tải lại trang để cập nhật trạng thái
                            Swal.fire('Thành công!', response.message, 'success');


                        },
                        error: function(xhr) {
                            Swal.fire('Lỗi!', xhr.responseJSON.message, 'error');
                        }
                    });
                }
            });
        }
    </script>
@endsection
