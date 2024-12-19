<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('posts')->insert([
            [
                'title' => 'Laravel Tutorial for Beginners',
                'short_description' => 'Laravel Tutorial for Beginners',
                'slug_post' => Str::slug('Laravel Tutorial for Beginners'),
                'content' => 'This is a beginner tutorial for Laravel...',
                'image_post'=>'',
                'published_id' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Advanced Laravel Tips',
                'short_description' => 'Advanced Laravel Tips',
                'slug_post' => Str::slug('Advanced Laravel Tips'),
                'content' => 'Here are some advanced tips for Laravel...',
                'image_post'=>'',
                'published_id' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Building a REST API with Laravel',
                'short_description' => 'Building a REST API with Laravel',
                'slug_post' => Str::slug('Building a REST API with Laravel'),
                'content' => 'This guide will help you build a REST API using Laravel...',
                'image_post'=>'',
                'published_id' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
