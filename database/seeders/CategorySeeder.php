<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $category = ['Áo', 'Quần', 'Váy', 'Túi sách'];
        foreach ($category as $item) {
            DB::table('categories')->insert([
                'name' => $item,
                'slug' => Str::slug($item),
                'note' => 'Ghi chú danh mục ' . $item,
                'image_cover' => 'https://studiovietnam.com/wp-content/uploads/2022/12/mau-anh-chup-ao-thun-nam-21.jpg',
            ]);
        }
    }
}
