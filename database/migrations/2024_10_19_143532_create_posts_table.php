<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id(); // Tự động tăng, khóa chính
            $table->string('title'); // Tiêu đề bài viết
            $table->mediumText('short_description'); // Mô tả ngắn cho bài viết
            $table->string('slug_post')->unique(); // Slug, duy nhất cho mỗi bài viết
            $table->string('image_post')->nullable();
            $table->longText('content'); // Nội dung bài viết
            $table->boolean('published_id')->default(false); // Trạng thái xuất bản, mặc định là false (chưa xuất bản)
            $table->timestamps(); // Thời gian tạo và cập nhật
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
