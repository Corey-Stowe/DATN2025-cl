@extends('admin::layout.master')
@section('title')
    Falcon | Dashboard
@endsection
@section('contents')
    <div class="row g-3 mb-3">
        <div class="col-md-6 col-xxl-4">
            <div class="card h-md-100 ecommerce-card-min-width">
                <div class="card-header pb-0">
                    <h6 class="mb-0 mt-2 d-flex align-items-center">Doanh thu tháng {{ $month }}<span
                            class="ms-1 text-400" data-bs-toggle="tooltip" data-bs-placement="top"
                            title="Calculated according to last week's sales">
                            {{-- <span class="far fa-question-circle"
                                data-fa-transform="shrink-1"></span> --}}
                        </span></h6>
                </div>
                <div class="card-body d-flex flex-column justify-content-end">
                    <div class="row">
                        <div class="col">
                            <p class="font-sans-serif lh-1 mb-1 fs-5"> {{ number_format($revenue, 0, ',', '.') }} VNĐ
                            </p>
                            {{-- <span
                                class="badge badge-subtle-success rounded-pill fs-11">+3.5%</span> --}}
                        </div>
                        <div class="col-auto ps-0">
                            <div class="bg-holder bg-card"
                                style="background-image:url({{ asset('theme/admin/img/icons/spot-illustrations/corner-3.png') }});">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xxl-4">
            <div class="card h-md-100">
                <div class="card-header pb-0">
                    <h6 class="mb-0 mt-2">Đơn hàng tháng {{ $month }}</h6>
                </div>
                <div class="card-body d-flex flex-column justify-content-end">
                    <div class="row justify-content-between">
                        <div class="col-auto align-self-end">
                            <div class="fs-5 fw-normal font-sans-serif text-700 lh-1 mb-1">
                                {{ number_format($totalMonthOrders, 0, ',', '.') }}</div>
                            {{-- <span class="badge rounded-pill fs-11 bg-200 text-primary"><span
                                    class="fas fa-caret-up me-1"></span>13.6%</span> --}}
                        </div>
                        <div class="col-auto ps-0 mt-n4">
                            {{-- <div class="echart-default-total-order"
                                data-echarts='{"tooltip":{"trigger":"axis","formatter":"{b0} : {c0}"},"xAxis":{"data":["Week 4","Week 5","Week 6","Week 7"]},"series":[{"type":"line","data":[20,40,100,120],"smooth":true,"lineStyle":{"width":3}}],"grid":{"bottom":"2%","top":"2%","right":"10px","left":"10px"}}'
                                data-echart-responsive="true"></div> --}}
                            <div class="bg-holder bg-card"
                                style="background-image:url({{ asset('theme/admin/img/icons/spot-illustrations/corner-3.png') }});">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xxl-4">
            <div class="card h-md-100">
                <div class="card-body">
                    <div class="row h-100 justify-content-between g-0">
                        <div class="col-5 col-sm-6 col-xxl pe-2">
                            <h6 class="mt-1">Tỉ lệ đặt hàng tháng {{ \Carbon\Carbon::now()->format('m') }}</h6>
                            <div class="fs-11 mt-3">
                                <div class="d-flex flex-between-center mb-1">
                                    <div class="d-flex align-items-center"><span class="dot bg-success"></span><span
                                            class="fw-semi-bold">Thành công</span></div>
                                    <div class="d-xxl-none">{{ $successfulMonthOrders }}%</div>
                                </div>
                                <div class="d-flex flex-between-center mb-1">
                                    <div class="d-flex align-items-center"><span class="dot bg-danger"></span><span
                                            class="fw-semi-bold">Thất Bại</span></div>
                                    <div class="d-xxl-none">{{ $cancelledMonthOrders }}%</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto position-relative">
                            <div class="echart-market-share"></div>
                            <div class="position-absolute top-50 start-50 translate-middle text-1100 fs-7">
                                <span class="fas fa-shopping-cart"></span>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="col-md-6 col-xxl-3">
            <div class="card h-md-100">
                <div class="card-header d-flex flex-between-center pb-0">
                    <h6 class="mb-0">Weather</h6>
                    <div class="dropdown font-sans-serif btn-reveal-trigger"><button
                            class="btn btn-link text-600 btn-sm dropdown-toggle dropdown-caret-none btn-reveal"
                            type="button" id="dropdown-weather-update" data-bs-toggle="dropdown" data-boundary="viewport"
                            aria-haspopup="true" aria-expanded="false"><span
                                class="fas fa-ellipsis-h fs-11"></span></button>
                        <div class="dropdown-menu dropdown-menu-end border py-2" aria-labelledby="dropdown-weather-update">
                            <a class="dropdown-item" href="#!">View</a><a class="dropdown-item"
                                href="#!">Export</a>
                            <div class="dropdown-divider"></div><a class="dropdown-item text-danger"
                                href="#!">Remove</a>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-2">
                    <div class="row g-0 h-100 align-items-center">
                        <div class="col">
                            <div class="d-flex align-items-center"><img class="me-3"
                                    src="{{ asset('theme/admin/img/icons/weather-icon.png') }}" alt=""
                                    height="60" />
                                <div>
                                    <h6 class="mb-2">New York City</h6>
                                    <div class="fs-11 fw-semi-bold">
                                        <div class="text-warning">Sunny</div>Precipitation: 50%
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto text-center ps-2">
                            <div class="fs-5 fw-normal font-sans-serif text-primary mb-1 lh-1">31&deg;
                            </div>
                            <div class="fs-10 text-800">32&deg; / 25&deg;</div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
    <div class="row g-3 mb-3">
        <div class="col-sm-6 col-md-4">
            <div class="card overflow-hidden" style="min-width: 12rem">
                <div class="bg-holder bg-card"
                    style="background-image:url({{ asset('theme/admin/img/icons/spot-illustrations/corner-1.png') }});">
                </div>
                <div class="card-body position-relative">
                    <h6>Đơn hàng chờ xác nhận</h6>
                    <div class="display-4 fs-5 mb-2 fw-normal font-sans-serif text-warning"
                        data-countup='{"endValue":58.386,"decimalPlaces":2,"suffix":"k"}'>
                        {{ number_format($listPending, 0, ',', '.') }}
                    </div>
                    {{-- <a class="fw-semi-bold fs-10 text-nowrap"
                        href="">Chi tiết<span
                            class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span></a> --}}
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-4">
            <div class="card overflow-hidden" style="min-width: 12rem">
                <div class="bg-holder bg-card"
                    style="background-image:url({{ asset('theme/admin/img/icons/spot-illustrations/corner-2.png') }});">
                </div>
                <div class="card-body position-relative">
                    <h6>Đơn hàng đang giao tháng {{ $month }}</h6>
                    <div class="display-4 fs-5 mb-2 fw-normal font-sans-serif text-info"
                        data-countup='{"endValue":23.434,"decimalPlaces":2,"suffix":"k"}'>
                        {{ number_format($delivering, 0, ',', '.') }}</div>
                    {{-- <a
                        class="fw-semi-bold fs-10 text-nowrap" href="">Chi
                        tiết <span class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span></a> --}}
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card overflow-hidden" style="min-width: 12rem">
                <div class="bg-holder bg-card"
                    style="background-image:url({{ asset('theme/admin/img/icons/spot-illustrations/corner-3.png') }});">
                </div>
                <div class="card-body position-relative">
                    <h6>Đơn hàng giao thành công tháng {{ $month }}</h6>
                    <div class="display-4 fs-5 mb-2 fw-normal font-sans-serif"
                        data-countup='{"endValue":43594,"prefix":"$"}'>{{ number_format($received, 0, ',', '.') }}</div>
                    {{-- <a
                        class="fw-semi-bold fs-10 text-nowrap"
                        href="">Chi tiết<span
                            class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span></a> --}}
                </div>
            </div>
        </div>
    </div>
    <div class="row g-0">
        <div class="col-lg-6 pe-lg-2 mb-3">
            <div class="card h-lg-100 overflow-hidden">
                <div class="card-header bg-body-tertiary">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="mb-0">Đơn hàng gần đây</h6>
                        </div>
                        {{-- <div class="col-auto text-center pe-x1"><select class="form-select form-select-sm">
                                <option>Working Time</option>
                                <option>Estimated Time</option>
                                <option>Billable Time</option>
                            </select></div> --}}
                    </div>
                </div>
                <div class="card-body p-0">
                    @foreach ($order as $item)
                        <div class="row g-0 align-items-center py-2 position-relative border-bottom border-200">
                            <div class="col ps-x1 py-1 position-static">
                                <div class="d-flex align-items-center">
                                    {{-- <div class="avatar avatar-xl me-3">
                                        <div class="avatar-name rounded-circle bg-primary-subtle text-dark">
                                            <span class="fs-9 text-primary">F</span>
                                        </div>
                                    </div> --}}
                                    <div class="flex-1">
                                        <h6 class="mb-0 d-flex align-items-center"><a class="text-800 stretched-link"
                                                href="{{ route('admin.orders.detail', ['order' => $item->id]) }}">Đơn hàng
                                                #{{ $item->id }}</a>
                                            {{-- <span
                                                class="badge rounded-pill ms-2 bg-200 text-primary">38%</span> --}}
                                        </h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col py-1">
                                <div class="row flex-end-center g-0">
                                    <div class="col-auto pe-2">
                                        <span
                                            class="badge rounded-pill ms-2 bg-200 text-primary">{{ $item->status_order }}</span>
                                        <span
                                            class="badge rounded-pill ms-2 bg-200 text-primary">{{ $item->status_payment }}</span>
                                    </div>
                                    {{-- <div class="col-5 pe-x1 ps-2">

                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
                <div class="card-footer bg-body-tertiary p-0"><a class="btn btn-sm btn-link d-block w-100 py-2"
                        href="{{ route('admin.orders.list') }}">Xem tất cả<span
                            class="fas fa-chevron-right ms-1 fs-11"></span></a></div>
            </div>
        </div>
        <div class="col-lg-6 pe-lg-2 mb-3">
            <div class="card h-lg-100 overflow-hidden">
                <div class="card-header bg-body-tertiary">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="mb-0">Phiếu hỗ trợ gần đây</h6>
                        </div>
                        <div class="col-auto text-center pe-x1">
                            {{-- <select class="form-select form-select-sm">
                                <option>Working Time</option>
                                <option>Estimated Time</option>
                                <option>Billable Time</option>
                            </select> --}}
                            <h6 class="mb-0">trạng thái</h6>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    @foreach ($listTicket as $item)
                        <div class="row g-0 align-items-center py-2 position-relative border-bottom border-200">
                            <div class="col ps-x1 py-1 position-static">
                                <div class="d-flex align-items-center">
                                    {{-- <div class="avatar avatar-xl me-3">
                                        <div class="avatar-name rounded-circle bg-primary-subtle text-dark">
                                            <span class="fs-9 text-primary">F</span>
                                        </div>
                                    </div> --}}
                                    <div class="flex-1">
                                        <h6 class="mb-0 d-flex align-items-center"><a class="text-800 stretched-link"
                                                href="{{ route('admin.ticket.show', ['id' => $item->ticket_id, 'user_id' => $item->user_id]) }}">
                                                {{ $item->ticket_title }}
                                            </a>
                                            {{-- <span
                                                class="badge rounded-pill ms-2 bg-200 text-primary">38%</span> --}}
                                        </h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col py-1">
                                <div class="row flex-end-center g-0">
                                    <div class="col-auto pe-2">
                                        {{-- <span class="badge rounded-pill ms-2 bg-200 text-primary">

                                        </span> --}}
                                        @if ($item->ticket_status == 1)
                                            <span class="badge bg-warning">Mở</span>
                                        @elseif($item->ticket_status == 2)
                                            <span class="badge bg-success">Hoàn thành</span>
                                        @else
                                            <span class="badge bg-danger">Spam</span>
                                        @endif
                                        {{-- <span  class="badge rounded-pill ms-2 bg-200 text-primary"></span> --}}
                                    </div>
                                    {{-- <div class="col-5 pe-x1 ps-2">

                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="card-footer bg-body-tertiary p-0"><a class="btn btn-sm btn-link d-block w-100 py-2"
                        href="{{ route('admin.ticket.index') }}">Xem tất cả<span
                            class="fas fa-chevron-right ms-1 fs-11"></span></a></div>
            </div>
        </div>
    </div>
    <div class="row g-0">
        <div class="col-lg-12 col-xl-12 ps-lg-12 mb-3">
            <div class="card h-100">
                <div class="card-header d-flex flex-between-center bg-body-tertiary py-2">
                    <h6 class="mb-0">Doanh thu theo các tháng</h6>
                </div>
                <div class="card-body pb-0">
                    <div class="echart-basic-bar-chart-example" style="min-height: 300px;" data-echart-responsive="true">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row g-0">
        <div class="col-lg-7 col-xl-8 pe-lg-2 mb-3">
            <div class="card h-lg-100 overflow-hidden">
                <div class="card-body p-0">
                    <div class="table-responsive scrollbar">
                        <table class="table table-dashboard mb-0 table-borderless fs-10 border-200">
                            <thead class="bg-body-tertiary">
                                <tr>
                                    <th class="text-900">Sản phẩm bán chạy</th>
                                    <th class="text-900 text-end">Số lượng bán</th>
                                    {{-- <th class="text-900 pe-x1 text-end" style="width: 8rem">Revenue (%)
                                    </th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bestSell as $item)
                                    <tr class="border-bottom border-200">
                                        <td>
                                            <div class="d-flex align-items-center position-relative"><img
                                                    class="rounded-1 border border-200" src="{{ $item->image_avatar }}"
                                                    width="60" alt="" />
                                                <div class="flex-1 ms-3">
                                                    <h6 class="mb-1 fw-semi-bold"><a class="text-1100 stretched-link"
                                                            href="{{ route('admin.product.detailP', ['slug' => $item->slug]) }}">{{ $item->name }}</a>
                                                    </h6>
                                                    <p class="fw-semi-bold mb-0 text-500">{{ $item->sku }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle text-end fw-semi-bold">{{ $item->total_quantity }}</td>
                                        {{-- <td class="align-middle pe-x1">
                                            <div class="d-flex align-items-center">
                                                <div class="progress me-3 rounded-3 bg-200"
                                                    style="height: 5px; width:80px;" role="progressbar"
                                                    aria-valuenow="39" aria-valuemin="0" aria-valuemax="100">
                                                    <div class="progress-bar rounded-pill" style="width: 39%;"></div>
                                                </div>
                                                <div class="fw-semi-bold ms-2">39%</div>
                                            </div>
                                        </td> --}}
                                    </tr>
                                @endforeach


                            </tbody>
                        </table>
                    </div>
                </div>
                {{-- <div class="card-footer bg-body-tertiary py-2">
                    <div class="row flex-between-center">
                        <div class="col-auto"><select class="form-select form-select-sm">
                                <option>Last 7 days</option>
                                <option>Last Month</option>
                                <option>Last Year</option>
                            </select></div>
                        <div class="col-auto"><a class="btn btn-sm btn-falcon-default" href="#!">View All</a></div>
                    </div>
                </div> --}}
            </div>
        </div>
        <div class="col-lg-5 col-xl-4 ps-lg-2 mb-3">
            <div class="card h-100">
                <div class="card-header d-flex flex-between-center bg-body-tertiary py-2">
                    <h6 class="mb-0">Bình luận gần đây</h6><a class="py-1 fs-10 font-sans-serif"
                        href="{{ route('admin.comment.listComment') }}">Xem tất
                        cả</a>
                </div>
                <div class="card-body pb-0">
                    @foreach ($listComment as $item)
                        <div class="d-flex mb-3 hover-actions-trigger align-items-center">
                            {{-- <div class="file-thumbnail"><img class="border h-100 w-100 object-fit-cover rounded-2"
                                    src="{{ asset('theme/admin/img/products/5-thumb.png') }}" alt="" /></div> --}}
                            <div class="ms-3 flex-shrink-1 flex-grow-1">
                                <h6 class="mb-1">
                                    <a class="stretched-link text-900 fw-semi-bold"
                                        href="{{ route('admin.comment.editComment', ['id' => $item]) }}">{{ Str::limit($item->comments, 35, '...') }}</a>
                                </h6>

                            </div>
                        </div>
                        <hr class="text-200" />
                    @endforeach


                </div>
            </div>
        </div>
    </div>
    <div class="row g-0">
        <div class="col-md-6 col-xxl-3 pe-md-2 mb-3 mb-xxl-0">
            <div class="card">
                <div class="card-header d-flex flex-between-center bg-body-tertiary py-2">
                    <h6 class="mb-0">Khách hàng mới</h6>
                    {{-- <div class="dropdown font-sans-serif btn-reveal-trigger"><button
                            class="btn btn-link text-600 btn-sm dropdown-toggle dropdown-caret-none btn-reveal"
                            type="button" id="dropdown-active-user" data-bs-toggle="dropdown" data-boundary="viewport"
                            aria-haspopup="true" aria-expanded="false"><span
                                class="fas fa-ellipsis-h fs-11"></span></button>
                        <div class="dropdown-menu dropdown-menu-end border py-2" aria-labelledby="dropdown-active-user"><a
                                class="dropdown-item" href="#!">View</a><a class="dropdown-item"
                                href="#!">Export</a>
                            <div class="dropdown-divider"></div><a class="dropdown-item text-danger"
                                href="#!">Remove</a>
                        </div>
                    </div> --}}
                </div>
                <div class="card-body py-2">
                    @foreach ($listUser as $item)
                        <div class="d-flex align-items-center position-relative mb-3">
                            <div class="avatar avatar-2xl">
                                <img class="rounded-circle" src="{{ Storage::url(Auth::user()->user_image) }}" alt="" />
                            </div>
                            <div class="flex-1 ms-3">
                                <h6 class="mb-0 fw-semi-bold"><a class="stretched-link text-900"
                                        href="{{ route('admin.users.show', ['id' => $item->id]) }}">{{ $item->full_name }}</a>
                                </h6>
                                <p class="text-500 fs-11 mb-0">Khách hàng</p>
                            </div>
                        </div>
                    @endforeach


                </div>
                <div class="card-footer bg-body-tertiary p-0"><a class="btn btn-sm btn-link d-block w-100 py-2"
                        href="{{ route('admin.users.index') }}">Xem tất cả<span
                            class="fas fa-chevron-right ms-1 fs-11"></span></a></div>
            </div>
        </div>
        <div class="col-md-6 col-xxl-3 ps-md-2 order-xxl-1 mb-3 mb-xxl-0">
            <div class="card h-100">
                <div class="card-header bg-body-tertiary d-flex flex-between-center py-2">
                    <h6 class="mb-0">Số lượng bài viết</h6>
                </div>
                <div class="card-body d-flex flex-center flex-column">
                    <!-- Find the JS file for the following chart at: src/js/charts/echarts/bandwidth-saved.js--><!-- If you are not using gulp based workflow, you can find the transpiled code at: public/assets/js/theme.js-->

                    <div class="text-center mt-3">
                        <h6 class="fs-9 mb-1"><span class="fas fa-check text-success me-1"
                                data-fa-transform="shrink-2"></span>{{ $coutPost }} bài viết công khai</h6>
                        {{-- <p class="fs-10 mb-0">38.44 GB total bandwidth</p> --}}
                    </div>
                </div>
                <div class="card-footer bg-body-tertiary py-2">
                    {{-- <div class="row flex-between-center">
                        <div class="col-auto"><select class="form-select form-select-sm">
                                <option>Last 6 Months</option>
                                <option>Last Year</option>
                                <option>Last 2 Year</option>
                            </select></div>
                        <div class="col-auto"><a class="fs-10 font-sans-serif" href="#!">Help</a>
                        </div>
                    </div> --}}
                    <div class="card-footer bg-body-tertiary p-0"><a class="btn btn-sm btn-link d-block w-100 py-2"
                            href="{{ route('admin.posts.list') }}">Xem tất cả<span
                                class="fas fa-chevron-right ms-1 fs-11"></span></a></div>
                </div>
            </div>
        </div>
        <div class="col-xxl-6 px-xxl-2">
            <div class="card h-lg-100 overflow-hidden">
                <div class="card-body p-0">
                    <div class="table-responsive scrollbar">
                        <table class="table table-dashboard mb-0 table-borderless fs-10 border-200">
                            <thead class="bg-body-tertiary">
                                <tr>
                                    <th class="text-900">5 tài khoản đặt nhiều nhất</th>
                                    <th class="text-900 text-end">Số lượng đơn</th>
                                    <th class="text-900 pe-x1 text-end" style="width: 8rem">Tổng tiền
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bestCustomers as $item)
                                    <tr class="border-bottom border-200">
                                        <td>
                                            <div class="d-flex align-items-center position-relative">
                                                {{-- <img
                                                    class="rounded-1 border border-200" src="{{ $item->image_avatar }}"
                                                    width="60" alt="" /> --}}
                                                <div class="flex-1 ms-3">
                                                    <h6 class="mb-1 fw-semi-bold"><a class="text-1100 stretched-link"
                                                            href="{{ route('admin.users.show', ['id' => $item->id]) }}">{{ $item->full_name }}</a>
                                                    </h6>
                                                    <p class="fw-semi-bold mb-0 text-500">{{ $item->email }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle text-end fw-semi-bold">{{ $item->total_orders }}</td>
                                        <td class="align-middle text-end fw-semi-bold">{{ number_format($item->total_spend, 0, ',', '.') }} VNĐ</td>
                                        {{-- <td class="align-middle pe-x1">
                                            <div class="d-flex align-items-center">
                                                <div class="progress me-3 rounded-3 bg-200"
                                                    style="height: 5px; width:80px;" role="progressbar"
                                                    aria-valuenow="39" aria-valuemin="0" aria-valuemax="100">
                                                    <div class="progress-bar rounded-pill" style="width: 39%;"></div>
                                                </div>
                                                <div class="fw-semi-bold ms-2">39%</div>
                                            </div>
                                        </td> --}}
                                    </tr>
                                @endforeach


                            </tbody>
                        </table>
                    </div>
                </div>
                {{-- <div class="card-footer bg-body-tertiary py-2">
                    <div class="row flex-between-center">
                        <div class="col-auto"><select class="form-select form-select-sm">
                                <option>Last 7 days</option>
                                <option>Last Month</option>
                                <option>Last Year</option>
                            </select></div>
                        <div class="col-auto"><a class="btn btn-sm btn-falcon-default" href="#!">View All</a></div>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
@endsection
@section('js-setting')
    <script src="{{ asset('theme/admin/vendors/echarts/echarts.min.js') }}"></script>
    <script src="{{ asset('theme/admin/js/echarts-example.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            echartsBasicBarChartInit();
            marketShareInit();
        });

        function echartsBasicBarChartInit() {
            var $barChartEl = document.querySelector('.echart-basic-bar-chart-example');
            if ($barChartEl) {
                // Get options from data attribute
                var userOptions = utils.getData($barChartEl, 'options');
                var chart = window.echarts.init($barChartEl);
                var months = ['T1', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7', 'T8', 'T9',
                    'T10', 'T11', 'T12'
                ];
                var data = @json($salesData); // Ensure this is an array of numbers

                // Custom tooltip formatter function to format values as VND
                var tooltipFormatter = function(params) {
                    if (params && params.length > 0) {
                        var month = months[params[0].dataIndex]; // Get the month from the data index
                        var value = params[0].value; // Get the value for the corresponding month

                        // Debugging: Log the value to check its type
                        console.log('Value:', value, 'Type:', typeof value);

                        // Ensure value is a number
                        if (typeof value === 'number') {
                            return month + ': ' + value.toLocaleString('vi-VN', {
                                style: 'currency',
                                currency: 'VND'
                            }); // Format the value as VND
                        } else {
                            return month + ': ' + value; // Fallback if not a number
                        }
                    }
                    return '';
                };

                var getDefaultOptions = function getDefaultOptions() {
                    return {
                        tooltip: {
                            trigger: 'axis',
                            padding: [7, 10],
                            backgroundColor: utils.getGrays()['100'],
                            borderColor: utils.getGrays()['300'],
                            textStyle: {
                                color: utils.getGrays()['1100']
                            },
                            borderWidth: 1,
                            formatter: tooltipFormatter, // Use the custom formatter
                            transitionDuration: 0,
                            axisPointer: {
                                type: 'none'
                            }
                        },
                        xAxis: {
                            type: 'category',
                            data: months,
                            axisLine: {
                                lineStyle: {
                                    color: utils.getGrays()['300'],
                                    type: 'solid'
                                }
                            },
                            axisTick: {
                                show: false
                            },
                            axisLabel: {
                                color: utils.getGrays()['400'],
                                formatter: function(value) {
                                    return value; // Keep the full month label
                                },
                                margin: 15
                            },
                            splitLine: {
                                show: false
                            }
                        },
                        yAxis: {
                            type: 'value',
                            boundaryGap: true,
                            axisLabel: {
                                show: true,
                                color: utils.getGrays()['400'],
                                margin: 15,
                                formatter: function(value) {
                                    return value.toLocaleString('vi-VN', {
                                        style: 'currency',
                                        currency: 'VND'
                                    }); // Format Y-axis labels as VND
                                }
                            },
                            splitLine: {
                                show: true,
                                lineStyle: {
                                    color: utils.getGrays()['200']
                                }
                            },
                            axisTick: {
                                show: false
                            },
                            axisLine: {
                                show: false
                            },
                            min: 600
                        },
                        series: [{
                            type: 'bar',
                            name: 'Total',
                            data: data,
                            lineStyle: {
                                color: utils.getColor('primary')
                            },
                            itemStyle: {
                                color: utils.getColor('primary'),
                                barBorderRadius: [3, 3, 0, 0]
                            },
                            showSymbol: false,
                            symbol: 'circle',
                            smooth: false,
                            hoverAnimation: true
                        }],
                        grid: {
                            right: '3%',
                            left: '10%',
                            bottom: '10%',
                            top: '5%'
                        }
                    };
                };

                echartSetOption(chart, userOptions, getDefaultOptions);
            }
        }

        function marketShareInit() {
            var ECHART_MARKET_SHARE = '.echart-market-share';
            var $echartMarketShare = document.querySelector(ECHART_MARKET_SHARE);
            if ($echartMarketShare) {
                var userOptions = utils.getData($echartMarketShare, 'options');
                var chart = window.echarts.init($echartMarketShare);
                var getDefaultOptions = function getDefaultOptions() {
                    return {
                        color: [utils.getColors().success, utils.getColors().danger, utils.getGrays()[300]],
                        tooltip: {
                            trigger: 'item',
                            padding: [7, 10],
                            backgroundColor: utils.getGrays()['100'],
                            borderColor: utils.getGrays()['300'],
                            textStyle: {
                                color: utils.getGrays()['1100']
                            },
                            borderWidth: 1,
                            transitionDuration: 0,
                            formatter: function formatter(params) {
                                return "<strong>".concat(params.data.name, ":</strong> ").concat(params.percent,
                                    "%");
                            }
                        },
                        position: function position(pos, params, dom, rect, size) {
                            return getPosition(pos, params, dom, rect, size);
                        },
                        legend: {
                            show: false
                        },
                        series: [{
                            type: 'pie',
                            radius: ['100%', '87%'],
                            avoidLabelOverlap: false,
                            hoverAnimation: false,
                            itemStyle: {
                                borderWidth: 2,
                                borderColor: utils.getColor('gray-100')
                            },
                            label: {
                                normal: {
                                    show: false,
                                    position: 'center',
                                    textStyle: {
                                        fontSize: '20',
                                        fontWeight: '500',
                                        color: utils.getGrays()['100']
                                    }
                                },
                                emphasis: {
                                    show: false
                                }
                            },
                            labelLine: {
                                normal: {
                                    show: false
                                }
                            },
                            data: [{
                                value: {{ $successfulMonthOrders }},
                                name: 'Thành Công'
                            }, {
                                value: {{ $cancelledMonthOrders }},
                                name: 'Thất Bại'
                            }, ]
                        }]
                    };
                };
                echartSetOption(chart, userOptions, getDefaultOptions);
            }
        };
    </script>
@endsection
