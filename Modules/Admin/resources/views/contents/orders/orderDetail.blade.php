@extends('admin::layout.master')

@section('title')
    Chi tiết đơn hàng #{{ $data->id }}
@endsection
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
@section('contents')
    @if (session('success'))
        <div class="card mb-3">
            <div class="card-header">
                <h5 class="fs-9 mb-0 text-nowrap py-2 py-xl-0 text-success">{{ session('success') }}</h5>
            </div>
        </div>
    @endif
    @if (session('error'))
        <div class="card mb-3">
            <div class="card-header">
                <h5 class="fs-9 mb-0 text-nowrap py-2 py-xl-0 text-danger">{{ session('error') }}</h5>
            </div>
        </div>
    @endif
    <div class="card mb-3">
        <div class="bg-holder d-none d-lg-block bg-card"
            style="background-image:url({{ asset('theme/admin/img/icons/spot-illustrations/corner-4.png') }});opacity: 0.7;">
        </div>
        <form class="card-body position-relative" action="{{ route('admin.orders.update', $data) }}" method="POST">
            @csrf
            @method('PUT')
            <h5>Đơn hàng chi tiết: #{{ $data->id }}</h5>
            <p class="fs-10">{{ $data->date_create_order }}</p>
            <div>
                @php
                    $badgeColors = [
                        $statusOrder['reorder'] => 'warning',
                        $statusOrder['pending'] => 'secondary',
                        $statusOrder['confirmed'] => 'info',
                        $statusOrder['shipping'] => 'primary',
                        $statusOrder['received'] => 'success',
                        $statusOrder['canceled'] => 'danger',
                        $statusPayment['paid'] => 'success',
                        $statusPayment['unpaid'] => 'danger',
                    ];
                @endphp
                <strong class="me-2">Trạng thái đơn hàng: </strong>
                <div class="badge rounded-pill badge-subtle-{{ $badgeColors[$data->status_order] }} fs-11">
                    {{ $data->status_order }}
                </div>
                @if (
                    $data->status_order != \App\Models\Order::STATUS_ORDER['received'] &&
                        $data->status_order != \App\Models\Order::STATUS_ORDER['shipping'] &&
                        $data->status_order != \App\Models\Order::STATUS_ORDER['canceled']
                )
                    <select class="form-control" name="status_order" style="margin: 17px 0px 17px 0px; width: 300px;">
                        <option value="sltNull" selected>Chọn</option>
                        @foreach (\App\Models\Order::STATUS_ORDER as $key => $value)
                            @if ($key == 'received' || $key == 'canceled')
                                <?php continue; ?>
                            @endif
                            <option value="{{ $key }}" {{ $data->status_order == $value ? 'selected' : '' }}>
                                {{ $value }}
                            </option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
        </form>

        <!-- Modal trigger button -->
        @if ($data->status_payment == 'Đã thanh toán')
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalId">
                Hủy và hoàn tiền đơn hàng
            </button>
        @else
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalId1">
                Hủy đơn hàng
            </button>
        @endif

        <!-- Modal Body -->
        <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
        <div class="modal fade" id="modalId" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
            role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitleId">
                            Xác nhận hủy và hoàn tiền đơn hàng
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('admin.orders.cancelAndRefund', $data) }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="reason">Lý do hủy đơn hàng</label>
                                <textarea class="form-control" name="reason" id="reason" rows="3" required></textarea>
                                <input type="hidden" name="status_order" value="canceled">
                                <input type="hidden" name="order_id" value="{{ $data->id }}">
                                <input type="hidden" name="user_id" value="{{ $data->users_id }}">
                                <input type="hidden" name="total_price" value="{{ $data->total_price }}">
                                <input type="hidden" name="full_name" value="{{ $data->user_name }}">
                            </div>
                            <p class="text-danger">Lưu ý: Hủy đơn hàng sẽ không thể khôi phục lại</p>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                Quay lại
                            </button>
                            <button type="submit" class="btn btn-primary">Hủy đơn hàng và hoàn tiền</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modalId1" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
            role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitleId">
                            Xác nhận hủy đơn hàng
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('admin.orders.cancel', $data) }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="reason">Lý do hủy đơn hàng</label>
                                <textarea class="form-control" name="reason" id="reason" rows="3" required></textarea>
                                <input type="hidden" name="status_order" value="canceled">
                                <input type="hidden" name="order_id" value="{{ $data->id }}">
                            </div>
                            <p class="text-danger">Lưu ý: Hủy đơn hàng sẽ không thể khôi phục lại</p>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                Quay lại
                            </button>
                            <button type="submit" class="btn btn-primary">Hủy đơn hàng</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Optional: Place to the bottom of scripts -->
        @endif
    </div>
    </form>
    </div>
    <div class="card mb-3">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 col-lg-4 mb-4 mb-lg-0">
                    <h5 class="mb-3 fs-9">Người đặt đơn</h5>
                    <h6 class="mb-2">{{ $data->user_name }}</h6>
                    <p class="mb-1 fs-10">{{ $data->user_address }}</p>
                    <p class="mb-0 fs-10"> <strong>Email: </strong><a
                            href="mailto:{{ $data->user_email }}">{{ $data->user_email }}</a>
                    </p>
                    <p class="mb-0 fs-10"> <strong>Điện thoại: </strong><a
                            href="tel:{{ $data->user_phone }}">{{ $data->user_phone }}</a></p>
                </div>
                <div class="col-md-6 col-lg-4 mb-4 mb-lg-0">
                    <h5 class="mb-3 fs-9">Người nhận hàng</h5>
                    <h6 class="mb-2">{{ $data->ship_user_name }}</h6>
                    <p class="mb-0 fs-10">{{ $data->ship_user_address }}</p>
                    <p class="mb-0 fs-10"> <strong>Email: </strong><a
                            href="mailto:{{ $data->ship_user_email }}">{{ $data->ship_user_email }}</a>
                    </p>
                    <p class="mb-0 fs-10"> <strong>Điện thoại: </strong><a
                            href="tel:{{ $data->ship_user_phone }}">{{ $data->ship_user_phone }}</a></p>
                    <div class="mb-0 fs-10">Ghi chú đơn hàng:<strong> {{ $data->ship_user_note }} </strong></div>
                </div>
                <div class="col-md-6 col-lg-4 mb-4 mb-lg-0">
                    <h5 class="mb-3 fs-9">Phương thức thanh toán</h5>
                    <h6 class="mb-2">{{ $data->payment_method }}</h6>
                    <strong class="me-2">Trạng thái thanh toán: </strong>
                    <div
                        class="mb-0 fs-10 badge rounded-pill badge-subtle-{{ $badgeColors[$data->status_payment] }} fs-11">
                        {{ $data->status_payment }}
                    </div>
                    @if ($data->status_payment == 'Chưa thanh toán')
                        <form action="{{ route('admin.orders.udtPayment', $data) }}" method="post" class="mt-3">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-success">Đã thanh toán</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="card mb-3">
        <div class="card-body">
            <div class="table-responsive fs-10">
                <table class="table table-striped border-bottom">
                    <thead class="bg-200">
                        <tr>
                            <th class="text-900 border-0">Sản phẩm</th>
                            <th class="text-900 border-0 text-center">Ảnh</th>
                            <th class="text-900 border-0 text-center">Option</th>
                            <th class="text-900 border-0 text-center">Số lượng</th>
                            <th class="text-900 border-0 text-end">Đơn giá (VNĐ)</th>
                            <th class="text-900 border-0 text-end">Tổng</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data->orderItems as $itemOrder)
                            <tr class="border-200">
                                <td class="align-middle">
                                    <h6 class="mb-0 text-nowrap">{{ $itemOrder->product_name }}</h6>
                                    <p class="mb-0">{{ $itemOrder->product_sku }}</p>
                                </td>
                                <td class="align-middle text-center">
                                    @php
                                        $url = $itemOrder->product_avatar;
                                        if (!\Str::contains($url, 'http')) {
                                            $url = \Storage::url($url);
                                        }
                                    @endphp
                                    <img src="{{ $url }}" alt="....." width="50px">
                                </td>
                                <td class="align-middle text-start">
                                    @php
                                        $prdV = \App\Models\ProductVariant::query()->findOrFail(
                                            $itemOrder->product_variant_id,
                                        );
                                    @endphp
                                    Màu: <span class="badge bg"
                                        style="background-color: {{ $prdV->color['color_value'] }};">{{ $prdV->color['color_value'] }}</span>
                                    <br>
                                    Kích thước: <strong>{{ $prdV->size['size_value'] }}</strong>
                                </td>
                                <td class="align-middle text-center">{{ $itemOrder->product_quantity }}</td>
                                <td class="align-middle text-end">
                                    {{ number_format((int) $itemOrder->product_price_final, 0, ',', '.') }}
                                </td>
                                <td class="align-middle text-end">
                                    {{ number_format((int) $itemOrder->product_price_final * $itemOrder->product_quantity, 0, ',', '.') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card mb-3">
        @if ($data->status_order == 'Đang giao hàng' && isset($frist_location))
            <div class="card-header">
                <h3 class="text-center mt-3">Trạng thái giao hàng</h3>
            </div>
            <div class="card-body">
                <!-- Card lồng -->
                <div class="card mb-3">
                    <div class="card-body">
                        <form action="{{ route('admin.orders.updateShip') }}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="location">Nhập địa chỉ cập nhật</label>
                                <input type="text" class="form-control" id="location" name="location" required>
                                <ul id="results" style="list-style: none; padding: 0; margin: 10px 0;"></ul>
                            </div>
                            <div class="form-group mb-3">
                                <label for="status">Trạng thái giao hàng</label>
                                <input type="text" class="form-control" id="status" name="status" required>
                            </div>
                            <input type="hidden" name="order_id" value="{{ $data->id }}">
                            <input type="hidden" name="latitude" id="latitude">
                            <input type="hidden" name="longitude" id="longitude">

                            <button type="submit" class="btn btn-primary w-100">
                                Cập nhật trạng thái giao hàng
                            </button>
                            <p class="text-danger">Lưu ý: Tool này là tool mô phỏng, không phản ánh đến dữ liệu thực</p>
                        </form>
                    </div>
                </div>

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
            </div>
        @else
            <div class="card-body">
                @if (isset($frist_location))
                    <p class="text-danger">Đơn hàng chưa được xác nhận hoặc đã hủy</p>
                @else
                    <p class="text-danger">Đơn hàng chưa được tạo vận đơn</p>
                @endif
                @if (!in_array($data->status_order, ['Đơn hàng bị hủy', 'Đặt lại hàng']))
                    <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal"
                        data-bs-target="#modalId2">
                        Tạo đơn vận mới
                    </button>
                @endif

                <!-- Modal -->
                <div class="modal fade" id="modalId2" tabindex="-1" role="dialog" aria-labelledby="modalTitleId"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalTitleId">
                                    Tạo đơn vận mới
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="container-fluid">Nếu bạn tạo đơn vận mới, đơn hàng sẽ chuyển trạng thái "Đang
                                    vận chuyển".</div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                    Hủy
                                </button>
                                <a href="{{ route('admin.orders.createship', ['id' => $data->id]) }}"
                                    class="btn btn-primary">
                                    Tạo vận đơn
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <script>
        let deliveryMarker; // Khai báo biến toàn cục
        let map; // Khai báo biến toàn cục

        @if (isset($frist_location))
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

        // Xử lý tìm kiếm với Nominatim
        $('#location').on('input', function() {
            clearTimeout(debounceTimer);
            const query = $(this).val();
            debounceTimer = setTimeout(() => {
                if (query.length > 2) {
                    // Gửi yêu cầu tới Nominatim API
                    $.getJSON(`https://nominatim.openstreetmap.org/search?format=json&q=${query}`, function(
                        data) {
                        $('#results').empty();
                        data.forEach(place => {
                            $('#results').append(
                                `<li data-lat="${place.lat}" data-lon="${place.lon}" style="cursor: pointer; padding: 5px; border: 1px solid #ccc;">${place.display_name}</li>`
                            );
                        });
                    });
                }
            }, 300); // Delay of 300ms
        });

        // Khi người dùng chọn địa chỉ từ danh sách
        $('#results').on('click', 'li', function() {
            const lat = $(this).data('lat');
            const lon = $(this).data('lon');

            // Cập nhật marker và bản đồ
            deliveryMarker.setLatLng([lat, lon]).bindPopup(`Vị trí: ${lat}, ${lon}`).openPopup(); // Không lỗi nữa
            map.setView([lat, lon], 15);

            // Xóa danh sách kết quả
            $('#results').empty();
            $('#location').val($(this).text());
            $('#latitude').val(lat);
            $('#longitude').val(lon);
            $('#status').val($(this).text());
        });
    </script>



@endsection
