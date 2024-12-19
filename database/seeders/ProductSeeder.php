<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sub = DB::table('sub_categories')->pluck('id')->toArray();
        for ($i = 1; $i <= 3; $i++) {
            DB::table('products')->insert([
                'sub_category_id' => $sub[array_rand($sub)],
                'name' => "Áo Cộc $i",
                'sku' => "ao-coc-1-xyz$i",
                'slug' => "ao-coc12323-$i",
                'image_avatar' => fake()->imageUrl(),
                'price_regular' => rand(100000, 1000000),
                'price_sale' => rand(80000, 900000),
                'discount_percent' => rand(10, 50),
                'description' => "Sản phẩm chất lắm thề $i",
                'material' => "Chất liệu: vải thô $i",
                'views' => rand(0, 100),
                'quantity' => rand(10, 100),
                'start_date' => now(),
                'end_date' => now()->addDays(30),
                'is_active' => 1,
            ]);
        }
    }
}
