@extends('admin::layout.master')
@section('title')
    Admin | Thống kê
@endsection
@section('contents')
    <div class="d-flex mb-4 mt-3">
        <span class="fa-stack me-2 ms-n1">
            <i class="fas fa-circle fa-stack-2x text-300"></i>
            <i class="fa-inverse fa-stack-1x text-primary fas fa-percentage"></i>
        </span>
        <div class="col">
            <h5 class="mb-0 text-primary position-relative">
                <span class="bg-200 dark__bg-1100 pe-3">Thống kê doanh thu</span>
                <span class="border position-absolute top-50 translate-middle-y w-100 start-0 z-n1"></span>
            </h5>
        </div>
    </div>

    <div class="row g-3 mb-3">
        <div class="card">
            <div class="card-header d-flex flex-between-center bg-body-tertiary py-2">
                <h5 class="mb-0">Lọc </h5>
                <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#filterCollapse" aria-expanded="false" aria-controls="filterCollapse">
                    Hiện bộ lọc
                </button>
            </div>
            <div class="collapse" id="filterCollapse">
                <div class="card-body">
                    <form action="{{ route('admin.statistical.listStatistical') }}" method="GET">
                        <div class="row g-3">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="start_date">Ngày bắt đầu:</label>
                                    <div class="input-group">
                                        <input type="date" class="form-control" id="start_date" name="start_date" value="{{ $startDate }}">
                                        <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="end_date">Ngày kết thúc:</label>
                                    <div class="input-group">
                                        <input type="date" class="form-control" id="end_date" name="end_date" value="{{ $endDate }}">
                                        <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="status_order">Trạng thái đơn hàng:</label>
                                    <select class="form-select" id="status_order" name="status_order">
                                        <option value="">Tất cả</option>
                                        <option value="reorder" {{ request('status_order') == 'reorder' ? 'selected' : '' }}>Đặt lại</option>
                                        <option value="pending" {{ request('status_order') == 'pending' ? 'selected' : '' }}>Chờ xử lý</option>
                                        <option value="confirmed" {{ request('status_order') == 'confirmed' ? 'selected' : '' }}>Đã xác nhận</option>
                                        <option value="shipping" {{ request('status_order') == 'shipping' ? 'selected' : '' }}>Đang giao</option>
                                        <option value="received" {{ request('status_order') == 'received' ? 'selected' : '' }}>Đã nhận</option>
                                        <option value="canceled" {{ request('status_order') == 'canceled' ? 'selected' : '' }}>Đã hủy</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone">Số điện thoại:</label>
                                    <input type="text" class="form-control" id="phone" name="phone" value="{{ request('phone') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email:</label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ request('email') }}">
                                </div>
                            </div>
                            <div class="col-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">Thống kê</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="row g-3 mb-3">
        <div class="col-sm-6 col-md-4">
            <div class="card overflow-hidden" style="min-width: 12rem">
                <div class="bg-holder bg-card"
                    style="background-image:url({{ asset('theme/admin/img/icons/spot-illustrations/corner-1.png') }});">
                </div>
                <div class="card-body position-relative">
                    <h6>Doanh thu</h6>
                    <div class="display-4 fs-5 mb-2 fw-normal font-sans-serif text-warning"
                        data-countup='{"endValue":58.386,"decimalPlaces":2,"suffix":"k"}'>{{ number_format($revenue) }}
                    </div><a class="fw-semi-bold fs-10 text-nowrap"
                        href="{{ route('admin.statistical.staticticalRevenue') }}">Chi tiết<span
                            class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span></a>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-4">
            <div class="card overflow-hidden" style="min-width: 12rem">
                <div class="bg-holder bg-card"
                    style="background-image:url({{ asset('theme/admin/img/icons/spot-illustrations/corner-2.png') }});">
                </div>
                <div class="card-body position-relative">
                    <h6>Đơn hàng</h6>
                    <div class="display-4 fs-5 mb-2 fw-normal font-sans-serif text-info"
                        data-countup='{"endValue":23.434,"decimalPlaces":2,"suffix":"k"}'>{{ $totalOrders }}</div><a
                        class="fw-semi-bold fs-10 text-nowrap" href="{{ route('admin.statistical.statisticalOrder') }}">Chi
                        tiết <span class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span></a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card overflow-hidden" style="min-width: 12rem">
                <div class="bg-holder bg-card"
                    style="background-image:url({{ asset('theme/admin/img/icons/spot-illustrations/corner-3.png') }});">
                </div>
                <div class="card-body position-relative">
                    <h6>Tỷ lệ thành công</h6>
                    <div class="display-4 fs-5 mb-2 fw-normal font-sans-serif"
                        data-countup='{"endValue":43594,"prefix":"$"}'>{{ $successRate }}%</div><a
                        class="fw-semi-bold fs-10 text-nowrap"
                        href="{{ route('admin.statistical.staticticalSuccess') }}">Chi tiết<span
                            class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span></a>
                </div>
            </div>
        </div>
    </div>

    <div class="card overflow-hidden mb-3">
        <div class="card-header p-0 scrollbar">
            <ul class="nav nav-tabs border-0 top-courses-tab flex-nowrap" role="tablist">

                <li class="nav-item" role="presentation"><a class="nav-link p-x1 mb-0 false active" role="tab"
                        id="popularFree-tab" data-bs-toggle="tab" href="#popularFree" aria-controls="popularFree"
                        aria-selected="true">
                        <div class="d-flex gap-1 py-1 pe-3">
                            <div class="ms-2">
                                <h5 class="mb-0 lh-1">Top 5 sản phẩm bán chạy</h5>
                            </div>
                        </div>
                    </a></li>
                <li class="nav-item" role="presentation"><a class="nav-link p-x1 mb-0" role="tab"
                        id="popularPaid-tab" data-bs-toggle="tab" href="#popularPaid" aria-controls="popularPaid"
                        aria-selected="false" tabindex="-1">
                        <div class="d-flex gap-1 py-1 pe-3">
                            <div class="ms-2">
                                <h5 class="mb-0 lh-1">Top 5 tài khoản đặt hàng nhiều</h5>
                            </div>
                        </div>
                    </a></li>
            </ul>
        </div>
        <div class="card-body p-0">
            <div class="tab-content">
                <div class="tab-pane" id="popularPaid" role="tabpanel" aria-labelledby="popularPaid-tab">
                    <div class="z-1" id="popularPaidCourses"
                        data-list="{&quot;valueNames&quot;:[&quot;title&quot;,&quot;name&quot;,&quot;published&quot;,&quot;enrolled&quot;,&quot;price&quot;],&quot;page&quot;:10}">
                        <div class="px-0 py-0">
                            <div class="table-responsive scrollbar">
                                <table class="table fs-10 mb-0 overflow-hidden">
                                    <thead class="bg-body-tertiary">
                                        <tr class="font-sans-serif">
                                            <th class="text-900 fw-medium sort pe-1 align-middle" data-sort="title">STT
                                            </th>
                                            <th class="text-900 fw-medium sort pe-1 align-middle" data-sort="name">Tên
                                                người dùng</th>
                                            <th class="text-900 fw-medium sort pe-1 align-middle text-end"
                                                data-sort="enrolled">Số lượng đơn hàng</th>
                                            <th class="text-900 fw-medium sort pe-1 align-middle text-end text-end"
                                                data-sort="price">Tổng số tiền</th>
                                        </tr>
                                    </thead>
                                    <tbody class="list">
                                        @foreach ($topUsers as $index => $user)
                                            <tr class="btn-reveal-trigger fw-semi-bold">
                                                <td class="align-middle white-space-nowrap title">
                                                    {{ $index + 1 }}
                                                </td>
                                                <td class="align-middle text-nowrap name">
                                                    {{ $user->user_name }}
                                                </td>
                                                <td class="align-middle white-space-nowrap text-end published">
                                                    {{ $user->total_orders }}</td>
                                                <td class="align-middle text-end enrolled">
                                                    {{ number_format($user->total_amount) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane active show" id="popularFree" role="tabpanel" aria-labelledby="popularFree-tab">
                    <div class="z-1" id="popularFreeCourses"
                        data-list="{&quot;valueNames&quot;:[&quot;title&quot;,&quot;name&quot;,&quot;published&quot;,&quot;enrolled&quot;,&quot;price&quot;],&quot;page&quot;:10}">
                        <div class="px-0 py-0">
                            <div class="table-responsive scrollbar">
                                <table class="table fs-10 mb-0 overflow-hidden">
                                    <thead class="bg-body-tertiary">
                                        <tr class="font-sans-serif">
                                            <th class="text-900 fw-medium sort pe-1 align-middle" data-sort="title">STT
                                            </th>
                                            <th class="text-900 fw-medium sort pe-1 align-middle" data-sort="name">Tên sản
                                                phẩm</th>
                                            <th class="text-900 fw-medium sort pe-1 align-middle text-end"
                                                data-sort="published">Số lượng bán</th>
                                            <th class="text-900 fw-medium sort pe-1 align-middle text-end"
                                                data-sort="enrolled">Doanh thu</th>
                                            <th class="text-900 fw-medium no-sort pe-1 align-middle data-table-row-action">
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="list">
                                        @foreach ($topProducts as $index => $product)
                                            <tr class="btn-reveal-trigger fw-semi-bold">
                                                <td class="align-middle white-space-nowrap title">{{ $index + 1 }}</td>
                                                <td class="align-middle text-nowrap name">{{ $product->name }}</td>
                                                <td class="align-middle white-space-nowrap text-end published">
                                                    {{ $product->total_quantity }}</td>
                                                <td class="align-middle text-end enrolled">
                                                    {{ number_format($product->total_revenue) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer bg-body-tertiary py-2">
            <div class="row flex-between-center g-0">
            </div>
        </div>
    </div>



    <div class="card mb-3">
        <div class="card-header">
            <div class="row flex-between-center">
                <div class="col-4 col-sm-auto d-flex align-items-center pe-0">
                    <h5 class="fs-0 mb-0 text-nowrap py-2 py-xl-0">Danh sách đơn hàng</h5>
                </div>
                <div class="col-8 col-sm-auto text-end ps-2">
                    <div class="d-flex">
                        <div id="table-customers-replace-element">
                            <form action="{{ route('admin.statistical.listStatistical') }}" method="GET">
                                <input type="hidden" name="start_date" value="{{ $startDate }}">
                                <input type="hidden" name="end_date" value="{{ $endDate }}">
                                <input type="hidden" name="status_order" value="{{ request('status_order') }}">
                                <input type="hidden" name="phone" value="{{ request('phone') }}">
                                <input type="hidden" name="email" value="{{ request('email') }}">
                                <a href="{{ route('admin.statistical.export') }}" class="btn btn-success">Xuất Excel</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body pt-0">
                <div class="table-responsive scrollbar">
                    <table class="table table-hover table-striped overflow-hidden">
                        <thead>
                            <tr>
                                {{-- <th class="fs-10 fw-semi-bold text-nowrap">
                                    <div class="form-check mb-0 fs-10 d-flex align-items-center">
                                        <input class="form-check-input" id="checkbox-bulk-customers-select"
                                            type="checkbox"
                                            data-bulk-select='{"body":"table-customers-body","actions":"table-customers-actions","replaceElement":"table-customers-replace-element"}' />
                                    </div>
                                </th> --}}
                                <th class="fs-10 fw-semi-bold text-nowrap">ID</th>
                                <th class="fs-10 fw-semi-bold text-nowrap">Khách hàng</th>
                                <th class="fs-10 fw-semi-bold text-nowrap">Ngày đặt</th>
                                <th class="fs-10 fw-semi-bold text-nowrap">Tổng tiền</th>
                                <th class="fs-10 fw-semi-bold text-nowrap">Trạng thái đơn hàng </th>
                                <th class="fs-10 fw-semi-bold text-nowrap">Trạng thái thanh toán</th>
                                <th class="fs-10 fw-semi-bold text-nowrap"></th>
                            </tr>
                        </thead>
                        <tbody class="fs-10" id="table-customers-body">
                            @foreach ($orders as $order)
                                <tr>
                                    {{-- <td class="align-middle">
                                        <div class="form-check mb-0 fs-10">
                                            <input class="form-check-input" type="checkbox" name="order[]"
                                                value="{{ $order->id }}" />
                                        </div>
                                    </td> --}}
                                    <td class="align-middle">{{ $order->id }}</td>
                                    <td class="align-middle">{{ $order->user_name }}</td>
                                    <td class="align-middle">{{ $order->date_create_order }}</td>
                                    <td class="align-middle">{{ number_format($order->total_price) }}</td>
                                    <td class="align-middle">
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
                                        <span
                                            class="badge badge rounded-pill d-block badge-subtle-{{ $badgeColors[$order->status_order] }}">
                                            {{ $order->status_order }}
                                        </span>

                                        {{-- @switch($order->status_order)
                                            @case('reorder')
                                                <span class='badge badge-subtle-info'>Đặt lại</span>
                                            @break

                                            @case('pending')
                                                <span class='badge badge-subtle-warning'>Chờ xử lý</span>
                                            @break

                                            @case('confirmed')
                                                <span class='badge badge-subtle-primary'>Đã xác nhận</span>
                                            @break

                                            @case('shipping')
                                                <span class='badge badge-subtle-secondary'>Đang giao</span>
                                            @break

                                            @case('received')
                                                <span class='badge badge-subtle-success'>Đã nhận</span>
                                            @break

                                            @case('canceled')
                                                <span class='badge badge-subtle-danger'>Đã hủy</span>
                                            @break

                                            @default
                                                <span class='badge badge-subtle-secondary'>Chưa xác định</span>
                                        @endswitch --}}
                                    </td>
                                    <td class="align-middle">
                                        <span
                                            class="badge badge rounded-pill d-block badge-subtle-{{ $badgeColors[$order->status_payment] }}">
                                            {{ $order->status_payment }}
                                        </span>
                                    </td>
                                    <td class="align-middle text-end">
                                        <a href='{{ route('admin.orders.detail', ['order' => $order->id, 'param1' => 'value1']) }}'
                                            class='btn btn-sm btn-info'>
                                            <span class='text-white fas fa-eye'></span>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class='d-flex justify-content-center mt-3'>
                    {{ $orders->withQueryString()->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    @endsection
    @section('js-setting')
        <script src="{{ asset('theme/admin/vendors/chart/chart.umd.js') }}"></script>
    @endsection
