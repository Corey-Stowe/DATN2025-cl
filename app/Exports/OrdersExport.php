<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OrdersExport implements FromCollection, WithHeadings
{
    protected $startDate;
    protected $endDate;
    protected $status;
    protected $phone;
    protected $email;

    public function __construct($startDate, $endDate, $status, $phone, $email)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->status = $status;
        $this->phone = $phone;
        $this->email = $email;
    }

    public function collection()
    {
        $orders = Order::query();

        if ($this->status) {
            $orders->where('status_order', $this->status);
        }

        if ($this->phone) {
            $orders->where('ship_user_phone', 'like', '%' . $this->phone . '%');
        }

        if ($this->email) {
            $orders->where('ship_user_email', 'like', '%' . $this->email . '%');
        }

        if ($this->startDate && $this->endDate) {
            $orders->whereBetween('date_create_order', [$this->startDate, $this->endDate]);
        }

        return $orders->get()->map(function ($order) {
            return [
                'ID' => $order->id,
                'Tên khách hàng' => $order->ship_user_name,
                'Số điện thoại' => $order->ship_user_phone,
                'Email' => $order->ship_user_email,
                'Địa chỉ' => $order->ship_user_address,
                'Trạng thái đơn hàng' => $order->status_order, 
                'Tổng tiền' => $order->total_price,
                'Ngày đặt hàng' => $order->date_create_order,
                'Trạng thái thanh toán' => $order->payment_method == 1 ? 'Đã thanh toán' : 'Chưa thanh toán',
                'Ghi chú' => $order->ship_user_note,
                'Phương thức vận chuyển' => $order->shipping_method, 
            ];
        });
    }

    public function headings(): array
    {
        return [
            'ID',
            'Tên khách hàng',
            'Số điện thoại',
            'Email',
            'Địa chỉ',
            'Trạng thái đơn hàng',
            'Tổng tiền',
            'Ngày đặt hàng',
            'Trạng thái thanh toán',
            'Ghi chú', 
            'Phương thức vận chuyển', 
        ];
    }
}