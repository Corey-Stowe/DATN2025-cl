<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 2; $i++) {
            DB::table('sub_categories')->insert([
                'category_id' => rand(1, 4),
                'name' => fake()->name,
                'slug' => fake()->slug(),
                'note' => 'Ghi chú danh mục phụ ' . $i,
            ]);
        }
    }
}
