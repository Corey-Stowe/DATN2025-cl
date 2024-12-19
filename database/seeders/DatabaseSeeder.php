<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RolePermissionSeeder::class,
            CategorySeeder::class,
            SubCategorySeeder::class,
            UserSeeder::class,
            PremissonSeeder::class,
            CouponSeeder::class,
            BannerSeeder::class,
            ProductSeeder::class,
            CommentSeeder::class,
            OrderSeeder::class,
            ColorAttributesSeeder::class,
            SizeAttributeSeeder::class,
            ProductVariantSeeder::class,
            OrderDetailSeeder::class,
            NotificationSeeder::class,
            PostsTableSeeder::class,
            // ProductImageSeeder::class,
            // VariantValueSeeder::class
        ]);
    }
}
