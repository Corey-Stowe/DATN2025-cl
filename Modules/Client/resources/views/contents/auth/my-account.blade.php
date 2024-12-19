@extends('client::layouts.master')
@section('title')
    Tài khoản | Thời trang Phong cách Việt
@endsection
@section('css-setting')
    <style>
        .pagination-controls {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 20px;
            flex-wrap: wrap;
        }


        .pagination-controls button {
            background-color: #000000;
            color: white;
            border: none;
            padding: 8px 12px;
            margin: 0 5px;
            cursor: pointer;
            font-size: 14px;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }


        .pagination-controls .page-number.active {
            background-color: #a8741a;
            font-weight: bold;
        }


        .pagination-controls button:hover:not(.active) {
            background-color: #a8741a;
        }


        .pagination-controls button:disabled {
            background-color: #dcdcdc;
            cursor: not-allowed;
        }

        .pagination-controls .page-info {
            font-size: 14px;
            color: #333;
            margin: 0 10px;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background-color: #fff;
            margin: 5% auto;
            padding: 20px;
            border-radius: 5px;
            width: 80%;
            position: relative;
        }

        .close-button {
            position: absolute;
            top: 10px;
            right: 20px;
            font-size: 24px;
            cursor: pointer;
        }

        /* Style cho dropdown */
        .dropdown-menu {
            min-width: 120px;
            padding: 0.5rem 0;
            margin: 0;
            border-radius: 4px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .dropdown-item {
            padding: 0.5rem 1rem;
            font-size: 14px;
            color: #333;
            transition: background-color 0.2s;
        }

        .dropdown-item:hover {
            background-color: #f8f9fa;
            color: #222;
        }

        /* Giữ style của nút Kenne */
        .kenne-btn.dropdown-toggle {
            padding-right: 1.5rem;
        }

        .kenne-btn.dropdown-toggle::after {
            margin-left: 0.5rem;
        }

        /* Đảm bảo dropdown không bị overflow */
        .table td {
            position: relative;
        }

        /* Style cho dropdown button */
        .kenne-btn.dropdown-toggle {
            padding: 0.375rem 1.5rem;
            min-width: 100px;
            /* Đảm bảo nút có chiều rộng cố định */
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        /* Căn chỉnh mũi tên dropdown */
        .kenne-btn.dropdown-toggle::after {
            position: absolute;
            right: 8px;
            top: 50%;
            transform: translateY(-50%);
        }

        /* Style cho văn bản trong nút */
        .kenne-btn.dropdown-toggle span {
            margin-right: 8px;
            /* Tạo khoảng cách giữa chữ và mũi tên */
        }

        /* Các style khác giữ nguyên */
        .dropdown-menu {
            min-width: 120px;
            padding: 0.5rem 0;
            margin: 0;
            border-radius: 4px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .dropdown-item {
            padding: 0.5rem 1rem;
            font-size: 14px;
            color: #333;
            transition: background-color 0.2s;
        }

        .dropdown-item:hover {
            background-color: #f8f9fa;
            color: #222;
        }

        /* Đảm bảo dropdown không bị overflow */
        .table td {
            position: relative;
        }
    </style>
    <script src="{{ asset('sweetalert2/sweetalert2.all.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('sweetalert2/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endsection
@section('contents')
    <!-- Begin Kenne's Breadcrumb Area -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="breadcrumb-content">
                <h2 style="margin-top: 30px;">Thời trang Phong cách Việt</h2>
                <ul>

                            {{-- <li><a href="{{ route('index') }}">{{ sesssion('success') }}</a></li> --}}
                            <li class="active">Tài khoản</li>

                </ul>
            </div>
        </div>
    </div>
    <!-- Kenne's Breadcrumb Area End Here -->

    <!-- Begin Kenne's Page Content Area -->
    <main class="page-content">
        <div class="account-page-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3">
                        <ul class="nav myaccount-tab-trigger" id="account-page-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="account-dashboard-tab" data-bs-toggle="tab"
                                    href="#account-dashboard" role="tab" aria-controls="account-dashboard"
                                    aria-selected="true">Bảng điều khiển</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('wallet.index') }}" target="_blank"
                                    rel="noopener noreferrer">Quản lý ví điện tử</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="account-orders-tab" data-bs-toggle="tab" href="#account-orders"
                                    role="tab" aria-controls="account-orders" aria-selected="false">Đơn hàng</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="account-address-tab" data-bs-toggle="tab" href="#account-address"
                                    role="tab" aria-controls="account-address" aria-selected="false">Địa chỉ</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="account-details-tab" data-bs-toggle="tab" href="#account-details"
                                    role="tab" aria-controls="account-details" aria-selected="false">Cập nhật thông
                                    tin</a>
                            </li>
                            <li class="nav-item">
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="kenne-login_btn">Đăng xuất</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-9">
                        <div class="tab-content myaccount-tab-content" id="account-page-tab-content">
                            <div class="tab-pane fade show active" id="account-dashboard" role="tabpanel"
                                aria-labelledby="account-dashboard-tab">
                                <div class="myaccount-dashboard">
                                    <div class="rounded-top text-white d-flex flex-row mb-3"
                                        style="background-color: #000; height:200px;">
                                        <div class="ms-4 mt-5 d-flex flex-column" style="width: 150px;">
                                            <img src="{{ Storage::url(Auth::user()->user_image) }}" alt="Bạn chưa cập nhật ảnh đại diện cho hồ sơ cá nhân"
                                                class="img-fluid img-thumbnail mt-4 mb-2" style="width: 150px; z-index: 1">
                                        </div>
                                        <div class="ms-3" style="margin-top: 130px;">
                                            <h5 style="color: #dcdcdc;">{{ Auth::user()->full_name }}</h5>
                                        </div>
                                    </div>
                                    <div class="card-body p-4 text-black">
                                        <div class="text-body">
                                            <p class="lead fw-normal mb-1">Thông tin chung</p>
                                            <div class="p-4 bg-body-tertiary">
                                                <p class="font-italic mb-1">Email: {{ Auth::user()->email }}</p>
                                                <p class="font-italic mb-1">Số điện thoại:
                                                    {{ Auth::user()->phone == null ? 'Chưa cập nhật!' : Auth::user()->phone }}
                                                </p>
                                                <p class="font-italic mb-0">Địa chỉ:
                                                    {{ Auth::user()->address == null ? 'Chưa cập nhật!' : Auth::user()->address }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="account-orders" role="tabpanel"
                                aria-labelledby="account-orders-tab">
                                <div class="myaccount-orders">
                                    <h4 class="small-title">Đơn hàng của tôi</h4>
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Mã đơn hàng</th>
                                                    <th>Ngày</th>
                                                    <th>Trạng thái</th>
                                                    <th>Tổng</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                    </div>
                                    <div id="pagination-controls" class="pagination-controls"></div>
                                </div>
                                {{-- <div id="orderDetailsModal" class="modal" style="display: none;">
                                    <div class="modal-content">
                                        <span class="close-button" onclick="closeModal()">&times;</span>
                                        <!-- Container Chi tiết Đơn hàng -->
                                        <div id="order-details-content">
                                            <h4 class="header-title mb-3">Sản phẩm từ Đơn hàng #<span
                                                    id="order-id"></span>
                                            </h4>
                                            <h5 class="header-title mb-3">Trạng thái : <span id="order-status"></span>
                                            </h5>

                                            <div class="row mb-4">
                                                <!-- Bảng Sản phẩm Đơn hàng -->
                                                <div class="table-responsive">
                                                    <table class="table mb-0">
                                                        <thead class="table-light">
                                                            <tr>
                                                                <th>Sản phẩm</th>
                                                                <th>Số lượng</th>
                                                                <th>Giá</th>
                                                                <th>Tổng</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="order-items">
                                                            <!-- Sản phẩm đơn hàng sẽ được chèn vào đây -->
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="row mb-4">

                                                <div class="col-sm-12 col-md-6 col-lg-3">
                                                    <!-- Thông tin Giao hàng -->
                                                    <h4 class="header-title mb-3">Thông tin người nhận</h4>
                                                    <address id="shipping-info">
                                                        <!-- Chi tiết giao hàng sẽ được chèn vào đây -->
                                                    </address>
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-3">
                                                    <!-- Thông tin Thanh toán -->
                                                    <h4 class="header-title mb-3">Thông tin Thanh toán</h4>
                                                    <ul id="billing-info" class="list-unstyled mb-0">
                                                        <!-- Chi tiết thanh toán sẽ được chèn vào đây -->
                                                    </ul>
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-3">
                                                    <!-- Thông tin Giao hàng -->
                                                    <h4 class="header-title mb-3">Thông tin Giao hàng</h4>
                                                    <div id="delivery-info">
                                                        <!-- Chi tiết giao hàng sẽ được chèn vào đây -->
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-3">
                                                    <!-- Tóm tắt Đơn hàng -->
                                                    <h4 class="header-title mb-3">Tóm tắt Đơn hàng</h4>
                                                    <div class="table-responsive">
                                                        <table class="table mb-0">
                                                            <tbody id="order-summary">
                                                                <!-- Tóm tắt đơn hàng sẽ được chèn vào đây -->
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="row mb-4">
                                                <h4 class="header-title mb-3">google map</h4>

                                            </div>
                                            <div class="row mb-4">
                                                <h4 class="header-title mb-3">trạng thái vận chuyển</h4>

                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4 col-md-4 col-lg-2 col-sx-6">
                                                <button onclick="printInvoice()"
                                                    class="kenne-btn kenne-btn_sm print-button">In hóa đơn</button>

                                            </div>
                                        </div>

                                    </div>
                                </div> --}}

                            </div>

                            <div class="tab-pane fade" id="account-address" role="tabpanel"
                                aria-labelledby="account-address-tab">
                                <div class="myaccount-address">
                                    <p>Địa chỉ sau sẽ được sử dụng trên trang thanh toán theo mặc định.</p>
                                    <div class="row">
                                        <div class="col">
                                            <h4 class="small-title">Địa chỉ thanh toán</h4>
                                            <address>
                                                {{ Auth::user()->address == null ? 'Chưa cập nhật!' : Auth::user()->address }}
                                            </address>
                                        </div>
                                        <div class="col">
                                            <h4 class="small-title">Địa chỉ giao hàng</h4>
                                            <address>
                                                {{ Auth::user()->address == null ? 'Chưa cập nhật!' : Auth::user()->address }}
                                            </address>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="account-details" role="tabpanel"
                                aria-labelledby="account-details-tab">
                                <div class="myaccount-details">
                                    <form id="changePasswordForm" class="kenne-form" enctype="multipart/form-data">
                                        @csrf
                                        <div class="kenne-form-inner">
                                            <div class="single-input">
                                                <label for="account-details-firstname">Hình ảnh*</label>
                                                <img src="{{ Storage::url($user->user_image) }}" width="100px" alt="">
                                                <input name="user_image" id="user_image" type="file" >
                                                <div class="error-message" id="error-full_name"></div>
                                            </div>
                                            <div class="single-input">
                                                <label for="account-details-firstname">Họ và tên*</label>
                                                <input type="text" name="full_name" id="account-details-firstname"
                                                    value="{{ $user->full_name }}">
                                                <div class="error-message" id="error-full_name"></div>
                                            </div>
                                            <div class="single-input">
                                                <label for="account-details-address">Địa Chỉ*</label>
                                                <input type="text" name="address"id="address"
                                                    value="{{ $user->address }}">
                                                <div class="error-message" id="error-address"></div>
                                                <ul id="results" style="list-style: none; padding: 0; margin: 10px 0;"></ul>
                                                <script>
                                                    $('#address').on('input', function () {
                                                      const query = $(this).val();
                                                      if (query.length > 2) {
                                                          // Gửi yêu cầu tới Nominatim API
                                                          $.getJSON(`https://nominatim.openstreetmap.org/search?format=json&q=${query}`, function (data) {
                                                          $('#results').empty();
                                                          data.forEach(place => {
                                                              $('#results').append(`<li data-lat="${place.lat}" data-lon="${place.lon}" style="cursor: pointer; padding: 5px; border: 1px solid #ccc;">${place.display_name}</li>`);
                                                          });
                                                          });
                                                      }
                                                      });

                                                      // Khi người dùng chọn địa chỉ từ danh sách
                                                      $('#results').on('click', 'li', function () {

                                                      // Xóa danh sách kết quả
                                                      $('#results').empty();
                                                      $('#address').val($(this).text());
                                                      });

                                                </script>
                                            </div>
                                            <div class="single-input">
                                                <label for="account-details-phone">Số điện thoại*</label>
                                                <input type="text" name="phone" id="account-details-phone"
                                                    value="{{ $user->phone }}">
                                                <div class="error-message" id="error-phone"></div>
                                            </div>
                                            <div class="single-input">
                                                <label for="account-details-email">Email*</label>
                                                <input type="email" name="email" id="account-details-email"
                                                    value="{{ $user->email }}" readonly>
                                            </div>

                                            <div class="single-input">
                                                <label for="account-details-oldpass">Mật khẩu cũ*</label>
                                                <input type="password" name="current_password"
                                                    id="account-details-oldpass">
                                                <div class="error-message" id="error-current_password"></div>
                                            </div>

                                            <div class="single-input">
                                                <label for="account-details-newpass">Mật khẩu mới*</label>
                                                <input type="password" name="new_password" id="account-details-newpass">
                                                <div class="error-message" id="error-new_password"></div>
                                            </div>

                                            <div class="single-input">
                                                <label for="account-details-confpass">Xác nhận mật khẩu mới</label>
                                                <input type="password" name="new_password_confirmation"
                                                    id="account-details-confpass">
                                                <div class="error-message" id="error-new_password_confirmation"></div>
                                            </div>

                                            <div class="single-input">
                                                <button class="kenne-btn kenne-btn_dark" type="submit">
                                                    <span>Cập nhật</span>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Kenne's Account Page Area End Here -->
    </main>

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
@section('js-setting')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            function loadOrders(pageUrl = '/get-orders') {
                fetch(pageUrl, {
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                'content')
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        const tableBody = document.querySelector('.myaccount-orders tbody');
                        tableBody.innerHTML = '';

                        if (data.orders && data.orders.length > 0) {
                            data.orders.forEach(order => {
                                const row = document.createElement('tr');

                                // Tạo dropdown menu với các action tùy theo trạng thái
                                let actionButtons = `
                <div class="dropdown d-inline-block">
                    <button class="kenne-btn kenne-btn_sm dropdown-toggle d-flex align-items-center justify-content-center" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <span>Thao tác</span>
                    </button>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item view-order-btn" href="{{ route('index') }}/invoice/${order.id}" data-order-id="${order.id}">
                                Xem chi tiết
                            </a>
                        </li>
            `;
                        row.innerHTML = `
                <td><a class="account-order-id" href="javascript:void(0)">#${order.id}</a></td>
                <td>${order.date}</td>
                <td>${order.status}</td>
                <td>${order.total}</td>
                <td>${actionButtons}</td>
            `;
                                tableBody.appendChild(row);
                            });

                            // Thêm sự kiện click cho các action
                            document.querySelectorAll('.view-order-btn').forEach(button => {
                                button.addEventListener('click', function() {
                                    const orderId = this.getAttribute('data-order-id');
                                    openOrderDetails(orderId);
                                });
                            });

                            document.querySelectorAll('.cancel-order-btn').forEach(button => {
                                button.addEventListener('click', function() {
                                    const orderId = this.getAttribute('data-order-id');
                                    cancelOrder(orderId);
                                });
                            });

                            document.querySelectorAll('.reset-order-btn').forEach(button => {
                                button.addEventListener('click', function() {
                                    const orderId = this.getAttribute('data-order-id');
                                    resetOrder(orderId);
                                });
                            });

                            document.querySelectorAll('.received-order-btn').forEach(button => {
                                button.addEventListener('click', function() {
                                    const orderId = this.getAttribute('data-order-id');
                                    markOrderAsReceived(orderId);
                                });
                            });

                            updatePagination(data.pagination);
                        } else {
                            tableBody.innerHTML = '<tr><td colspan="5">Không tìm thấy đơn hàng nào.</td></tr>';
                        }
                    })
                    .catch(error => {
                        console.error('Lỗi khi lấy đơn hàng:', error);
                    });
            }

            // Cập nhật các nút phân trang dựa trên dữ liệu phản hồi
            function updatePagination(pagination) {
                const paginationContainer = document.querySelector('#pagination-controls');
                paginationContainer.innerHTML = ''; // Xóa các điều khiển phân trang hiện có

                // Tạo nút "Trước"
                const prevButton = document.createElement('button');
                prevButton.textContent = 'Trước';
                prevButton.disabled = !pagination.prev_page_url;
                prevButton.onclick = () => loadOrders(pagination.prev_page_url ||
                    `/get-orders?page=${pagination.current_page - 1}`);
                paginationContainer.appendChild(prevButton);

                // Thêm các nút trang được đánh số
                for (let i = 1; i <= pagination.last_page; i++) {
                    const pageButton = document.createElement('button');
                    pageButton.textContent = i;
                    pageButton.className = 'page-number';

                    // Làm nổi bật nút trang hiện tại
                    if (i === pagination.current_page) {
                        pageButton.classList.add('active');
                    }

                    // Đặt sự kiện click để tải trang cụ thể
                    pageButton.onclick = () => loadOrders(`/get-orders?page=${i}`);
                    paginationContainer.appendChild(pageButton);
                }

                // Tạo nút "Tiếp"
                const nextButton = document.createElement('button');
                nextButton.textContent = 'Tiếp';
                nextButton.disabled = !pagination.next_page_url;
                nextButton.onclick = () => loadOrders(pagination.next_page_url ||
                    `/get-orders?page=${pagination.current_page + 1}`);
                paginationContainer.appendChild(nextButton);

                // Hiển thị thông tin trang hiện tại
                const pageInfo = document.createElement('span');
                pageInfo.className = 'page-info';
                pageInfo.textContent = `Trang ${pagination.current_page} của ${pagination.last_page}`;
                paginationContainer.appendChild(pageInfo);
            }

            // Tải đơn hàng ban đầu
            loadOrders();
        });
        document.addEventListener("DOMContentLoaded", function() {
            const changePasswordForm = document.getElementById("changePasswordForm");

            changePasswordForm.addEventListener("submit", function(e) {
                e.preventDefault();

                let formData = new FormData(changePasswordForm);
                fetch("{{ route('change.password') }}", {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                            "Accept": "application/json"
                        },
                        body: formData
                    })
                    .then(response => {
                        if (!response.ok) {
                            return response.json().then(errorData => {
                                throw errorData;
                            });
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            // alert(data.message);
                            Swal.fire('Thành công!', data.message, 'success');
                            changePasswordForm.reset();
                        }
                    })
                    .catch(errorData => {
                        const errors = errorData.errors;
                        document.getElementById("error-full_name").innerText = errors.full_name || "";
                        document.getElementById("error-address").innerText = errors.address || "";
                        document.getElementById("error-current_password").innerText = errors
                            .current_password || "";
                        document.getElementById("error-new_password").innerText = errors.new_password ||
                            "";
                        document.getElementById("error-new_password_confirmation").innerText = errors
                            .new_password_confirmation || "";
                        document.getElementById("error-phone").innerText = errors.phone ||
                            ""; // Phone field error
                        if (errorData.error) {
                            alert(errorData.error);
                        }
                    });
            });
        });
    </script>
@endsection
