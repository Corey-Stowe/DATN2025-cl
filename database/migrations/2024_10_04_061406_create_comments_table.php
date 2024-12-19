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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('products_id');
            $table-> foreign('products_id')->references('id')->on('products');
            $table->unsignedBigInteger('users_id');
            $table-> foreign('users_id')->references('id')->on('users');
            $table->text('comments');
            $table->integer('rating')->default(5);
            $table->datetime('comment_date');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
