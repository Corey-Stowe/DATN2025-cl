<?php

use App\Models\Category;
use App\Models\SubCategory;
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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(SubCategory::class)->nullable()->constrained()->nullOnDelete()->cascadeOnUpdate();
            $table->string('name',255);
            $table->string('sku',255)->unique();
            $table->string('slug', 255)->unique();
            $table->string('image_avatar', 255);
            $table->integer('price_regular');
            $table->integer('price_sale')->nullable();
            $table->integer('discount_percent')->nullable();
            $table->text('description')->nullable();
            $table->text('material')->nullable();
            $table->bigInteger('views')->default(0);
            $table->bigInteger('quantity')->nullable();
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->boolean('is_active')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
