<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Lấy danh sách users_id từ bảng users
        $userIds = DB::table('users')->pluck('id')->toArray();
        // Lấy danh sách products_id từ bảng products
        $productIds = DB::table('products')->pluck('id')->toArray();

        if (!empty($userIds) && !empty($productIds)) {
            for ($i = 1; $i <= 3; $i++) {
                DB::table('comments')->insert([
                    'users_id' => $userIds[array_rand($userIds)], // Chọn ngẫu nhiên users_id
                    'products_id' => $productIds[array_rand($productIds)], // Chọn ngẫu nhiên products_id
                    'comments' => "Sản phẩm chất vãi ò $i",
                    'rating' => rand(1, 5),
                    'comment_date' => now(),
                ]);
            }
        }
    }
}
