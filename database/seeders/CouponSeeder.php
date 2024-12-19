<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 5; $i++) {
            DB::table('coupons')->insert([
                'name' => "Coupon $i",
                'date_start' => now(),
                'date_end' => now()->addDays(30),
                'code' => "GIAMGIA$i",
                'description' => "Mô tả mã giảm giá $i",
                'discount_amount' => rand(10, 50),
                'discount_type' => 'percent',
                'quantity' => 100,
                'minimum_spend' => rand(100000, 500000)
            ]);
        }

    }
}
