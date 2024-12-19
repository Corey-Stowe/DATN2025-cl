@extends('admin::layout.master')

@section('title')
    DANH SÁCH ĐƠN HÀNG
@endsection

@section('contents')
    <div class="card mb-3" id="ordersTable"
        data-list='{"valueNames":["order","address","status_order","status_payment"],"filter":{"key":"status_order"}}'>
        <form action="{{ route('admin.invoice.bulkActions') }}" method="POST">
            @csrf
            <div class="card-header">
                <div class="row flex-between-center">
                    <div class="col-4 col-sm-auto d-flex align-items-center pe-0">
                        @if (session()->has('error'))
                            <h5 class="fs-9 mb-0 text-nowrap py-2 py-xl-0 text-warning">{{ session('error') }}</h5>
                        @else
                            @if (session()->has('success'))
                                <h5 class="fs-9 mb-0 text-nowrap py-2 py-xl-0 text-success">{{ session('success') }}</h5>
                            @else
                                <h5 class="fs-9 mb-0 text-nowrap py-2 py-xl-0">ĐƠN HÀNG</h5>
                            @endif
                        @endif
                    </div>
                    <div class="col-8 col-sm-auto ms-auto text-end ps-0">
                        <div class="d-none" id="orders-bulk-actions">
                            <div class="d-flex">
                                <select class="form-select form-select-sm" name="slAction" aria-label="Bulk actions">
                                    <option value="sltNull" selected>Chọn hành động</option>
                                    {{-- <option value="confirmed">Đã xác nhận</option>
                                    <option value="shipping">Đang giao hàng</option> --}}
                                    <option value="print_invoices">In hoá đơn</option>
                                </select>
                                <input type="submit" class="btn btn-falcon-default btn-sm ms-2" name="btnApply"
                                    value="Áp dụng hàng loạt">
                            </div>
                        </div>
                        <div id="orders-actions">
                            <button class="btn btn-falcon-default btn-sm mx-2" type="button">
                                <span class="fas fa-filter" data-fa-transform="shrink-3 down-2"></span>
                                <span class="d-none d-sm-inline-block ms-1">Hành động</span>
                            </button>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row flex-between-center mb-3">
                    <div class="col-6 col-sm-auto d-flex align-items-center pe-0">
                        <div class="input-group">
                            <input class="form-control form-control-sm shadow-none search" type="search"
                                placeholder="Tìm kiếm tại đây" aria-label="search" />
                        </div>
                    </div>
                    <div class="col-6 col-sm-auto ms-auto text-end ps-0">
                        <select class="form-select form-select-sm mb-3" aria-label="Bulk actions"
                            data-list-filter="data-list-filter">
                            <option selected value="sltNull">Lọc theo trạng thái đơn hàng</option>
                            @foreach (\App\Models\Order::STATUS_ORDER as $value)
                                <option value="{{ $value }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive scrollbar">
                    <table class="table table-sm table-striped fs-10 mb-0 overflow-hidden">
                        <thead class="bg-200">
                            <tr>
                                <th>
                                    <div class="form-check fs-9 mb-0 d-flex align-items-center">
                                        <input class="form-check-input" id="checkbox-bulk-customers-select" type="checkbox"
                                            data-bulk-select='{"body":"table-orders-body","actions":"orders-bulk-actions","replacedElement":"orders-actions"}' />
                                    </div>
                                </th>
                                <th class="text-900 sort pe-1 align-middle white-space-nowrap" data-sort="order">Đơn hàng
                                </th>
                                <th class="text-900 sort pe-1 align-middle white-space-nowrap pe-7">Ngày đặt</th>
                                <th class="text-900 sort pe-1 align-middle white-space-nowrap" data-sort="address"
                                    style="min-width: 12.5rem;">Địa chỉ giao hàng</th>
                                <th class="text-900 sort pe-1 align-middle white-space-nowrap text-center"
                                    data-sort="status_order">
                                    Trạng thái đơn hàng
                                </th>
                                <th class="text-900 sort pe-1 align-middle white-space-nowrap text-center"
                                    data-sort="status_payment">
                                    Trạng thái thanh toán
                                </th>
                                <th class="text-900 sort pe-1 align-middle white-space-nowrap text-end">
                                    Tổng đơn hàng (VNĐ)
                                </th>
                                <th class="no-sort"></th>
                            </tr>
                        </thead>
                        <tbody class="list" id="table-orders-body">
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
                            @foreach ($data as $order)
                                <tr class="btn-reveal-trigger">
                                    <td class="align-middle" style="width: 28px;">
                                        <div class="form-check fs-9 mb-0 d-flex align-items-center">
                                            <input class="form-check-input" type="checkbox" name="idOrder[]"
                                                id="checkbox-{{ $order->id }}"
                                                data-bulk-select-row="data-bulk-select-row" value="{{ $order->id }}" />
                                        </div>
                                    </td>
                                    <td class="order py-2 align-middle white-space-nowrap">
                                        <a href="{{ route('admin.orders.detail',['order'=> $order->id]) }}">
                                            <strong>#{{ $order->id }}</strong>
                                        </a>
                                        của <strong>{{ $order->user_name }}</strong>
                                        <br />
                                        <a href="mailto:{{ $order->user_email }}">{{ $order->user_email }}</a>
                                    </td>
                                    <td class="py-2 align-middle">{{ $order->date_create_order }}</td>
                                    <td class="address py-2 align-middle white-space-nowrap">
                                        {{ \Illuminate\Support\Str::limit($order->ship_user_address, 20) }}...
                                    </td>
                                    <td class="status_order py-2 align-middle text-center fs-9 white-space-nowrap">
                                        <span
                                            class="badge badge rounded-pill d-block badge-subtle-{{ $badgeColors[$order->status_order] }}">
                                            {{ $order->status_order }}
                                        </span>
                                    </td>
                                    <td class="status_payment py-2 align-middle text-center fs-9 white-space-nowrap">
                                        <span
                                            class="badge badge rounded-pill d-block badge-subtle-{{ $badgeColors[$order->status_payment] }}">
                                            {{ $order->status_payment }}
                                        </span>
                                    </td>
                                    <td class="py-2 align-middle text-end fs-9 fw-medium">
                                        {{ number_format((int) $order->total_price, 0, ',', '.') }}
                                    </td>
                                    <td class="py-2 align-middle white-space-nowrap text-end">
                                        <div class="dropdown font-sans-serif position-static">
                                            <button class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal"
                                                type="button" id="order-dropdown-{{ $order->id }}"
                                                data-bs-toggle="dropdown" data-boundary="viewport" aria-haspopup="true"
                                                aria-expanded="false">
                                                <span class="fas fa-ellipsis-h fs-10"></span>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end border py-0"
                                                aria-labelledby="order-dropdown-0">
                                                <div class="py-2">
                                                    <a class="dropdown-item text-warning"
                                                        href="{{ route('admin.orders.detail', $order) }}">Chi tiết</a>
                                                    <a class="dropdown-item text-primary"
                                                        href="{{ route('admin.invoice.save', $order) }}">In hóa đơn</a>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </form>
        <div class="card-footer">
            <div class="row">
                <div class="col-lg-12">
                    {{ $data->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
@endsection
