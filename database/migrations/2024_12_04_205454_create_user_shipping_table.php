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
    Schema::create('user_shipping', function (Blueprint $table) {
        $table->id();
        $table->integer('order_id')->notNullable();
        $table->string('status', 255)->nullable();
        $table->float('latitude')->nullable();
        $table->float('longitude')->nullable();
        $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_shipping');
    }
};
