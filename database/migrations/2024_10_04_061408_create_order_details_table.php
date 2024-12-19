<?php

use App\Models\ProductVariant;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id')->references('id')->on('orders');
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products');
            // $table->unsignedBigInteger('product_variant_id');
            // $table->foreign('product_variant_id')->references('id')->on('product_variants');
            $table->foreignIdFor(ProductVariant::class)->constrained();
            $table->string('product_name',255);
            $table->string('product_sku',100);
            $table->string('product_avatar',255);
            $table->integer('product_price_final');
            $table->integer('product_quantity');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};
