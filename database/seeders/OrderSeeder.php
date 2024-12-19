<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orderStatuses = Order::STATUS_ORDER;
        $paymentStatus = Order::STATUS_PAYMENT;
        $paymentMethods = Order::METHOD_PAYMENT;
        $shippingMethods = Order::METHOD_SHIPPING;

        for ($i = 1; $i <= 3; $i++) {
            DB::table('orders')->insert([
                'users_id' => rand(2, 3),
                'user_name' => "uy" . rand(1, 10),
                'user_phone' => "098765432" . rand(1, 10),
                'user_email' => "uy" . rand(1, 10) . "@gmail.com",
                'user_address' => "Hà Nội $i",
                'ship_user_name' => "Đô $i",
                'ship_user_phone' => "0987654321",
                'ship_user_email' => "do1234$i@gmail.com",
                'ship_user_address' => "Địa chỉ người nhận $i",
                'ship_user_note' => "lêu lêu $i",
                'total_price' => rand(100000, 5000000),
                'status_order' => $orderStatuses[array_rand($orderStatuses)],
                'payment_method' => $paymentMethods[array_rand($paymentMethods)],
                'status_payment' => $paymentStatus[array_rand($paymentStatus)],
                'date_create_order' => now(),
                'discount' => 0,
                'shipping_method' => $shippingMethods[array_rand($shippingMethods)]
            ]);
        }
    }
}
