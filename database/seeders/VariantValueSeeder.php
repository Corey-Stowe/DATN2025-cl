<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class VariantValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 2; $i++) {
            DB::table('variant_values')->insert([
                'product_variant_id' => $i,
                'color_attribute_id' => rand(1, 10),
                'size_attribute_id' => rand(1, 5),
                'color_value' => "Màu sắc $i",
                'size_value' => "Kích thước $i"
            ]);
        }
    }
}
