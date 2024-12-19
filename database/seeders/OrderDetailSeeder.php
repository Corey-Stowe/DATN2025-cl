<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class OrderDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $productIds = DB::table('products')->pluck('id')->toArray();
        $productNames = DB::table('products')->pluck('name')->toArray();
        $productSkus = DB::table('products')->pluck('sku')->toArray();

        for ($i = 1; $i <= 3; $i++) {
            for ($j = 1; $j <= 2; $j++) {
                $randomKey = array_rand($productIds);
                DB::table('order_details')->insert([
                    'order_id' => $i,
                    'product_id' => $productIds[$randomKey],
                    'product_variant_id' => rand(1, 2),
                    'product_name' => $productNames[$randomKey],
                    'product_sku' => $productSkus[$randomKey],
                    'product_avatar' => "https://product.hstatic.net/1000392326/product/fas33679__k__968k_-_fjd31170__b__998k__1__f3577eb828354bdd9dd4dd48d632ea87_master.jpg",
                    'product_price_final' => rand(80000, 900000),
                    'product_quantity' => rand(1, 5)
                ]);
            }
        }

    }
}
