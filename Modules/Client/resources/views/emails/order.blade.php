<!DOCTYPE html>
<html lang="vi">
    <?php
      Use PhpOffice\PhpSpreadsheet\Style\NumberFormat\NumberFormatter;
    ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hóa Đơn #{{ $order->id }}</title>
    <style>
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 14px;
            line-height: 1.6;
            color: #333;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .invoice-container {
            max-width: 800px;
            margin: 20px auto;
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }
        .invoice-header {
            background-color: #3498db;
            color: #ffffff;
            padding: 20px;
            text-align: center;
        }
        .invoice-header h1 {
            font-size: 28px;
            margin: 0;
        }
        .invoice-body {
            padding: 20px;
        }
        .customer-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .customer-info div {
            flex: 1;
        }
        .order-items {
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #e0e0e0;
        }
        th {
            background-color: #f8f8f8;
            font-weight: bold;
        }
        .total-amount {
            background-color: #2ecc71;
            color: #ffffff;
            padding: 10px;
            border-radius: 5px;
            display: inline-block;
            margin-bottom: 10px;
        }
        .amount-in-words {
            font-style: italic;
            margin-bottom: 20px;
        }
        .invoice-footer {
            background-color: #f8f8f8;
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #777;
        }
        .text-right {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .highlight {
            font-weight: bold;
            color: #3498db;
        }
    </style>
</head>
<body>
    <div class="invoice-container">
        <div class="invoice-header">
            <h1>Hóa Đơn #{{ $order->id }}</h1>
        </div>
        <div class="invoice-body">
            <div class="customer-info">
                <div>
                    <h3>Thông tin người nhận</h3>
                    <p><strong>Tên:</strong> {{ $order->ship_user_name }}</p>
                    <p><strong>Email:</strong> {{ $order->ship_user_email }}</p>
                    <p><strong>Điện thoại:</strong> {{ $order->ship_user_phone }}</p>
                    <p><strong>Địa chỉ:</strong> {{ $order->ship_user_address }}</p>
                </div>
                <div>
                    <h3>Thông tin đơn hàng</h3>
                    <p><strong>Phương thức thanh toán:</strong> {{ $order->payment_method }}</p>
                    <p><strong>Ngày tạo:</strong> {{ $order->date_create_order }}</p>
                    <p><strong>Trạng thái thanh toán:</strong> {{ $order->status_payment }}</p>
                </div>
            </div>

            <div class="total-amount">
                <strong>Tổng đơn hàng:</strong> {{ number_format($order->total_price, 0, ',', '.') }} VNĐ
            </div>

            <div class="amount-in-words">
                @php
                    $formatter = new \NumberFormatter('vi_VN', \NumberFormatter::SPELLOUT);
                    $soTienBangChu = ucfirst($formatter->format($order->total_price));
                @endphp
                <strong>Số tiền viết bằng chữ:</strong> <i>{{ $soTienBangChu }}</i>.
            </div>

            <div class="order-items">
                <table>
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Đơn giá (VNĐ)</th>
                            <th>Tổng</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $stt = 1; @endphp
                        @foreach ($orderItems as $item)
                            <tr>
                                <td>{{ $stt }}</td>
                                <td>
                                    {{ $item['name'] }}<br>
                                    <small>Kích cỡ: {{ $item['size'] }}</small><br>
                                    <small>Màu: {{ $item['color'] }}</small>
                                </td>
                                <td>{{ $item['quantity'] }}</td>
                                <td>{{ number_format((int) $item['price'], 0, ',', '.') }}</td>
                                <td>{{ number_format((int) $item['price'] * $item['quantity'], 0, ',', '.') }}</td>
                            </tr>
                            @php $stt++; @endphp
                        @endforeach
                    </tbody>
                    <tfoot>
                        @foreach ($orderItems as $item)
                            <tr>
                                <td colspan="4" class="text-right"><strong>{{ $item['name'] }}:</strong></td>
                                <td>{{ number_format($item['price'], 0, ',', '.') }} VNĐ x {{ $item['quantity'] }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="4" class="text-right"><strong>Giảm giá:</strong></td>
                            <td>
                                @if ($order->discount > 0)
                                    {{ number_format($order->discount, 0, ',', '.') }} VNĐ
                                @else
                                    0 VNĐ
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4" class="text-right highlight">Tổng đơn hàng:</td>
                            <td class="highlight">{{ number_format($order->total_price, 0, ',', '.') }} VNĐ</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="invoice-footer">
            <p>Cảm ơn bạn đã mua hàng. Nếu có bất kỳ câu hỏi nào, vui lòng liên hệ với chúng tôi.</p>
            <p>&copy; 2023 Tên Công Ty Của Bạn. Đã đăng ký bản quyền.</p>
        </div>
    </div>
</body>
</html>
