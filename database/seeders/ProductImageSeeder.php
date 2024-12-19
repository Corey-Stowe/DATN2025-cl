<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class ProductImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 2; $i++) {
            for ($j = 1; $j <= 3; $j++) { // Mỗi sản phẩm có 3 hình ảnh
                DB::table('product_images')->insert([
                    'product_id' => $i,
                    'image_path' => "https://product.hstatic.net/1000392326/product/fas33679__k__968k_-_fjd31170__b__998k__1__f3577eb828354bdd9dd4dd48d632ea87_master.jpg"
                ]);
            }
        }
    }
}
