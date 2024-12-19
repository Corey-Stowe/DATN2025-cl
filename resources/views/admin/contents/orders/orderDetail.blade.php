@extends('layout.master')

@section('title')
    Detail Order
@endsection

@section('contents')
    <div class="card mb-3">
        <div class="bg-holder d-none d-lg-block bg-card"
            style="background-image:url({{ asset('theme/admin/assets/img/icons/spot-illustrations/corner-4.png') }});opacity: 0.7;">
        </div>
        <!--/.bg-holder-->
        <div class="card-body position-relative">
            <h5>Order Details: #43</h5>
            <p class="fs-10">20/03/2024</p>
            <div>
                {{-- @php
                    $badgeColors = [
                        $statusOrder['reorder'] => 'info',
                        $statusOrder['pending'] => 'secondary',
                        $statusOrder['confirmed'] => 'dark',
                        $statusOrder['preparing_goods'] => 'primary',
                        $statusOrder['shipping'] => 'primary',
                        $statusOrder['delivered'] => 'primary',
                        $statusOrder['received'] => 'success',
                        $statusOrder['canceled'] => 'danger',
                        $statusPayment['paid'] => 'success',
                        $statusPayment['unpaid'] => 'danger',
                    ];
                @endphp --}}
                <strong class="me-2">Status Order: </strong>
                <div class="badge rounded-pill badge-subtle-danger fs-11">
                    status order
                </div>
            </div>
        </div>
    </div>
    <div class="card mb-3">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 col-lg-4 mb-4 mb-lg-0">
                    <h5 class="mb-3 fs-9">Billing Address</h5>
                    <h6 class="mb-2">name 1</h6>
                    <p class="mb-1 fs-10">diachi 1</p>
                    <p class="mb-0 fs-10"> <strong>Email: </strong><a
                            href="mailto:testmail@gmail.com">testmail@gmail.com</a>
                    </p>
                    <p class="mb-0 fs-10"> <strong>Phone: </strong><a href="tel:093243242">093243242</a></p>
                </div>
                <div class="col-md-6 col-lg-4 mb-4 mb-lg-0">
                    <h5 class="mb-3 fs-9">Shipping Address</h5>
                    <h6 class="mb-2">name 1</h6>
                    <p class="mb-0 fs-10">diachi1</p>
                    <div class="text-500 fs-10">(Free Shipping)</div>
                </div>
                <div class="col-md-6 col-lg-4 mb-4 mb-lg-0">
                    <h5 class="mb-3 fs-9">Payment Method</h5>
                    <h6 class="mb-2">Thanh toán COD</h6>
                    {{-- <p class="mb-0 fs-10">{{ $data->user_address }}</p> --}}
                    <strong class="me-2">Status Payment: </strong>
                    <div class="mb-0 fs-10 badge rounded-pill badge-subtle-success fs-11">
                        status payment
                    </div>
                </div>
                {{-- <div class="col-md-6 col-lg-4">
                    <h5 class="mb-3 fs-9">Payment Method</h5>
                    <div class="d-flex"><img class="me-3" src="../../../assets/img/icons/visa.png" width="40"
                            height="30" alt="" />
                        <div class="flex-1">
                            <h6 class="mb-0">Antony Hopkins</h6>
                            <p class="mb-0 fs-10">**** **** **** 9809</p>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
    <div class="card mb-3">
        <div class="card-body">
            <div class="table-responsive fs-10">
                <table class="table table-striped border-bottom">
                    <thead class="bg-200">
                        <tr>
                            <th class="text-900 border-0">Products</th>
                            <th class="text-900 border-0 text-center">Product Image thumbnail</th>
                            <th class="text-900 border-0 text-center">Quantity</th>
                            <th class="text-900 border-0 text-end">Rate (VNĐ)</th>
                            <th class="text-900 border-0 text-end">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-200">
                            <td class="align-middle">
                                <h6 class="mb-0 text-nowrap">sanpham1</h6>
                                <p class="mb-0">dsfdsf0-96ydf</p>
                            </td>
                            <td class="align-middle text-center">
                                <img src="" alt="....." width="50px">
                            </td>
                            <td class="align-middle text-center">6</td>
                            <td class="align-middle text-end">
                                {{-- {{ number_format(
                                        (int) ($dataItem->product_sale_discount > 0
                                            ? $dataItem->product_price_regular * (1 - $dataItem->product_sale_discount / 100)
                                            : ($dataItem->product_price_sale > 0
                                                ? $dataItem->product_price_sale
                                                : $dataItem->product_price_regular)),
                                        0,
                                        ',',
                                        '.',
                                    ) }} --}}
                                232452323
                            </td>
                            <td class="align-middle text-end">
                                {{-- {{ number_format(
                                        (int) $dataItem->quantity *
                                            ($dataItem->product_sale_discount > 0
                                                ? $dataItem->product_price_regular * (1 - $dataItem->product_sale_discount / 100)
                                                : ($dataItem->product_price_sale > 0
                                                    ? $dataItem->product_price_sale
                                                    : $dataItem->product_price_regular)),
                                        0,
                                        ',',
                                        '.',
                                    ) }} --}}
                                345435345
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="row g-0 justify-content-end">
                <div class="col-auto">
                    <table class="table table-sm table-borderless fs-10 text-end">
                        <tr>
                            <th class="text-900">
                                sanpham1:
                            </th>
                            <td class="fw-semi-bold">
                                {{-- {{ number_format(
                                        (int) $dataItem->quantity *
                                            ($dataItem->product_sale_discount > 0
                                                ? $dataItem->product_price_regular * (1 - $dataItem->product_sale_discount / 100)
                                                : ($dataItem->product_price_sale > 0
                                                    ? $dataItem->product_price_sale
                                                    : $dataItem->product_price_regular)),
                                        0,
                                        ',',
                                        '.',
                                    ) }} --}}
                                656342
                                for 3
                            </td>
                        </tr>
                        {{-- <tr>
                            <th class="text-900">Tax 5%:</th>
                            <td class="fw-semi-bold">$311.50</td>
                        </tr> --}}
                        <tr class="border-top">
                            <th class="text-900">Total:</th>
                            <td class="fw-semi-bold">
                                {{ number_format((int) 355433, 0, ',', '.') }} (VNĐ)
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="row g-0">
                <div class="col-6">
                    <a class="btn btn-dark" href="">Back</a>
                </div>
                {{-- @if ($data->status_order == 'Đã nhận hàng' && $data->payment == 'Đã thanh toán') --}}
                <div class="col-6 text-end">
                    <a class="btn btn-warning" href="">Print Invoice</a>
                </div>
                {{-- @endif --}}
            </div>
        </div>
    </div>
@endsection
