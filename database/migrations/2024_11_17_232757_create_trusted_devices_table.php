<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('trusted_devices', function (Blueprint $table) {
            $table->id('device_id'); // ID thiết bị tin cậy
            $table->unsignedBigInteger('wallet_id'); // ID ví liên kết
            $table->string('device_identifier'); // ID duy nhất của thiết bị
            $table->string('device_name')->nullable(); // Tên thiết bị
            $table->string('device_type')->nullable(); // Loại thiết bị (mobile, desktop, etc.)
            $table->timestamp('last_used')->default(DB::raw('CURRENT_TIMESTAMP')); // Lần sử dụng gần nhất
            $table->boolean('is_active')->default(true); // Trạng thái thiết bị (true: active, false: inactive)
            $table->timestamps();

            // Liên kết khóa ngoại
            $table->foreign('wallet_id')->references('wallet_id')->on('wallet')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trusted_devices');
    }
};
