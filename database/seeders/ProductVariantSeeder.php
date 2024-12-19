<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class ProductVariantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 3; $i++) {
            DB::table('product_variants')->insert([
                'product_id' => $i,
                'color_attribute_id' => rand(1, 3),
                'size_attribute_id' => rand(1, 3),
                'price_default' => rand(100000, 1000000),
                'price_sale' => rand(80000, 900000),
                'start_date' => now(),
                'end_date' => now()->addDays(30),
                'quantity' => rand(10, 100)
            ]);
        }
    }
}
