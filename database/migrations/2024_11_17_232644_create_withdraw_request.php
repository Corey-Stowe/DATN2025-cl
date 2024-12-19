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
        Schema::create('withdraw_request', function (Blueprint $table) {
            $table->id('withdraw_request_id'); // Tự động tạo cột 'id' với AUTO_INCREMENT
            $table->string('wallet_account_id'); // ID của tài khoản ví
            $table->integer('amount'); // Số tiền cần rút
            $table->string('bank_account_number'); // Số tài khoản ngân hàng
            $table->string('bank_account_name'); // Tên chủ tài khoản ngân hàng
            $table->string('bank_name'); // Tên ngân hàng
            $table->tinyInteger('status')->default(0); // Trạng thái: 0-Pending, 1-Approved, 2-Rejected
            $table->string('description')->nullable(); // Mô tả thêm về yêu cầu
            $table->timestamp('request_date')->useCurrent(); // Ngày yêu cầu
            $table->timestamp('admin_response_date')->nullable(); // Ngày admin phản hồi
            $table->string('admin_note')->nullable(); // Ghi chú của admin
            $table->timestamps(); // Tự động thêm 'created_at' và 'updated_at'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('withdraw_request');
    }
};
