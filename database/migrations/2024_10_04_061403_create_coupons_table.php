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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('name',255);
            $table->dateTime('date_start');
            $table->dateTime('date_end');
            $table->string('code',50);
            $table->text('description');
            $table->integer('discount_amount');    
            $table->enum('discount_type',['percent','fixed']);
            $table->integer('quantity');
            $table->integer('minimum_spend');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
