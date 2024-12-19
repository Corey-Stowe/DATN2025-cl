<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class ColorAttributesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $colors = [
            '#FF0000', // Đỏ
            '#0000FF', // Xanh
            '#FFFF00', // Vàng
            '#FFFFFF', // Trắng
            '#000000', // Đen
            '#FFA500', // Cam
            '#800080', // Tím
            '#FFC0CB', // Hồng
            '#808080', // Xám
            '#A52A2A'  // Nâu
        ];
        foreach ($colors as $color) {
            DB::table('color_attributes')->insert([
                'color_value' => $color
            ]);
        }
    }
}
