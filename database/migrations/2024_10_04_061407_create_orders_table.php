<?php

use App\Models\Order;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('users_id');
            $table->foreign('users_id')->references('id')->on('users');
            $table->string('user_name', 100);
            $table->string('user_phone', 15)->nullable();
            $table->string('user_email', 100);
            $table->string('user_address', 255)->nullable();
            $table->string('ship_user_name', 100);
            $table->string('ship_user_phone', 15);
            $table->string('ship_user_email', 100);
            $table->string('ship_user_address', 255);
            $table->string('ship_user_note', 255)->nullable();
            $table->enum('status_order', [Order::STATUS_ORDER]);
            $table->enum('payment_method', [Order::METHOD_PAYMENT]);
            $table->enum('status_payment', [Order::STATUS_PAYMENT]);
            $table->integer('total_price');
            $table->dateTime('date_create_order');
            $table->integer('discount');
            $table->enum('shipping_method', [Order::METHOD_SHIPPING]);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
