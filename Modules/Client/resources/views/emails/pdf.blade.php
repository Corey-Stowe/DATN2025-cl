<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Hóa Đơn #{{ $order->id }}</title>
    <style>
        @font-face {
            font-family: 'DejaVu Sans';
            src: url('/fonts/DejaVuSans.ttf') format('truetype');
            font-weight: normal;
            font-style: normal;
        }

        @font-face {
            font-family: 'DejaVu Sans';
            src: url('/fonts/DejaVuSans-Bold.ttf') format('truetype');
            font-weight: bold;
            font-style: normal;
        }

        * {
            font-family: 'DejaVu Sans', sans-serif;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 14px;
            line-height: 1.6;
            color: #333;
            background-color: #f8f8f8;
        }

        .invoice-container {
            max-width: 800px;
            margin: 20px auto;
            padding: 40px;
            background-color: #ffffff;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .invoice-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #e0e0e0;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }

        .invoice-header h1 {
            font-size: 28px;
            color: #2c3e50;
            margin: 0;
        }

        .invoice-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
        }

        .invoice-info-block {
            flex: 1;
        }

        .invoice-info-block h4 {
            font-size: 16px;
            color: #2c3e50;
            margin-bottom: 10px;
        }

        .order-items table {
            width: 100%;
            border-collapse: collapse;
        }

        .order-items table th,
        .order-items table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #e0e0e0;
        }

        .order-items table th {
            background-color: #f1f8ff;
            color: #2c3e50;
            font-weight: 600;
        }

        .order-items table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .order-items table tr.tfoot th,
        .order-items table tr.tfoot td {
            background-color: #f1f8ff;
            font-weight: 600;
            border: none;
        }

        .total-amount {
            background-color: #27ae60;
            color: white;
            border-radius: 4px;
            padding: 8px 12px;
            display: inline-block;
            margin-top: 10px;
        }

        .amount-in-words {
            font-style: italic;
            color: #7f8c8d;
            margin-top: 10px;
        }

        .product-image {
            width: 70px;
            height: 70px;
            object-fit: cover;
            border-radius: 4px;
        }

        .invoice-footer {
            margin-top: 30px;
            text-align: center;
            color: #7f8c8d;
            font-size: 12px;
        }
    </style>
</head>

<body>
    <div class="invoice-container">
        <div class="invoice-header">
            <h1>Hóa Đơn #{{ $order->id }}</h1>
            <div>
                <strong>Ngày Tạo:</strong> {{ $order->date_create_order }}
            </div>
        </div>

        <div class="invoice-info">
            <div class="invoice-info-block">
                <h4>Thông Tin Người Nhận</h4>
                <p>
                    <strong>Tên:</strong> {{ $order->ship_user_name }}<br>
                    <strong>Email:</strong> {{ $order->ship_user_email }}<br>
                    <strong>Điện thoại:</strong> {{ $order->ship_user_phone }}<br>
                    <strong>Địa chỉ:</strong> {{ $order->ship_user_address }}
                </p>
            </div>
            <div class="invoice-info-block">
                <h4>Thông Tin Thanh Toán</h4>
                <p>
                    <strong>Phương thức:</strong> {{ $order->payment_method }}<br>
                    @php
                        $formatter = new NumberFormatter('vi_VN', NumberFormatter::SPELLOUT);
                        $soTienBangChu = $formatter->format($order->total_price);
                        $soTienBangChu = ucfirst($soTienBangChu);
                    @endphp
                    <div class="total-amount">
                        <strong>Tổng đơn hàng:</strong> {{ number_format($order->total_price, 0, ',', '.') }} VNĐ
                    </div>
                    <div class="amount-in-words">
                        {{ $soTienBangChu }} đồng.
                    </div>
                </p
            </div>
        </div>

        <div class="order-items">
            <table>
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>San pham</th>
                        <th>Anh</th>
                        <th>So Luong</th>
                        <th>Don gia (VND)</th>
                        <th>Tong</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $stt = 1;
                    @endphp
                    @foreach ($order->orderItems as $itemOrder)
                        <tr>
                            <td>{{ $stt }}</td>
                            <td>
                                {{ $itemOrder->product_name }}<br>
                                <small>{{ $itemOrder->product_sku }}</small>
                            </td>
                            <td>
                                <img src="{{ $itemOrder->product_avatar }}" alt="{{ $itemOrder->product_name }}" class="product-image">
                            </td>
                            <td>{{ $itemOrder->product_quantity }}</td>
                            <td>
                                {{ number_format((int) $itemOrder->product_price_final, 0, ',', '.') }}
                            </td>
                            <td>
                                {{ number_format((int) $itemOrder->product_price_final * $itemOrder->product_quantity, 0, ',', '.') }}
                            </td>
                        </tr>
                        @php
                            $stt++;
                        @endphp
                    @endforeach
                </tbody>
                <tfoot>
                    {{-- @foreach ($order->orderItems as $itemOrder)
                        <tr class="tfoot">
                            <th colspan="5" style="text-align: right;">{{ $itemOrder->product_name }}:</th>
                            <td style="text-align: right;">
                                {{ number_format((int) $itemOrder->product_price_final, 0, ',', '.') }}
                                x {{ $itemOrder->product_quantity }}
                            </td>
                        </tr>
                    @endforeach
                    <tr class="tfoot">
                        <th colspan="5" style="text-align: right;">Ma Khuyen Mai:</th>
                        <td style="text-align: right;">
                            {{ $order->code_coupon != '' ? $order->code_coupon : 'Khong Ap Dung' }}
                        </td>
                    </tr>
                    <tr class="tfoot">
                        <th colspan="5" style="text-align: right;">Kieu Giam Gia:</th>
                        <td style="text-align: right;">{{ $order->discount_type }}</td>
                    </tr> --}}
                    <tr class="tfoot">
                        <th colspan="5" style="text-align: right;">Giam Gia:</th>
                        <td style="text-align: right;">
                            @if ($order->discount > 0)
                                {{ $order->discount_type == 'Cố định' ? number_format($order->discount, 0, ',', '.') : $order->discount . '%' }}
                            @else
                              0 VND
                            @endif
                        </td>
                    </tr>
                    <tr class="tfoot">
                        <th colspan="5" style="text-align: right; border-top: 2px solid #2c3e50;">Tong:</th>
                        <th style="text-align: right; border-top: 2px solid #2c3e50;">
                            {{ number_format($order->total_price, 0, ',', '.') }} VND
                        </th>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="invoice-footer">
            Cảm ơn quý khách đã mua hàng. Chúc quý khách một ngày tốt lành!
        </div>
    </div>
</body>

</html>
