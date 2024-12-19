<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            DB::table('banners')->insert([
                'banner_position'=> 1,
                'title'=> 'tiêu đề1',
                'description'=> 'mô tả1',
                'offer_text' => 'nội dung1',
                'img_banner' => "https://product.hstatic.net/1000392326/product/fas33679__k__968k_-_fjd31170__b__998k__1__f3577eb828354bdd9dd4dd48d632ea87_master.jpg"
            ]);
            DB::table('banners')->insert([
                'banner_position'=> 3,
                'title'=> 'tiêu đề1',
                'description'=> 'mô tả1',
                'offer_text' => 'nội dung1',
                'img_banner' => "https://product.hstatic.net/1000392326/product/fas33679__k__968k_-_fjd31170__b__998k__1__f3577eb828354bdd9dd4dd48d632ea87_master.jpg"
            ]);
            DB::table('banners')->insert([
                'banner_position'=> 3,
                'title'=> 'tiêu đề2',
                'description'=> 'mô tả2',
                'offer_text' => 'nội dung3',
                'img_banner' => "https://product.hstatic.net/1000392326/product/fas33679__k__968k_-_fjd31170__b__998k__1__f3577eb828354bdd9dd4dd48d632ea87_master.jpg"
            ]);
            DB::table('banners')->insert([
                'banner_position'=> 4,
                'title'=> 'tiêu đề1',
                'description'=> 'mô tả1',
                'offer_text' => 'nội dung1',
                'img_banner' => "https://product.hstatic.net/1000392326/product/fas33679__k__968k_-_fjd31170__b__998k__1__f3577eb828354bdd9dd4dd48d632ea87_master.jpg"
            ]);

    }
}
