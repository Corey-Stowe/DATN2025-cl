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
        Schema::create('trx_history', function (Blueprint $table) {
            $table->id('trx_id'); // ID giao dịch
            $table->string('wallet_account_id'); // ID của tài khoản ví liên quan
            $table->string('trx_type'); // Loại giao dịch (Deposit, Withdraw, Transfer...)
            $table->string('trx_from')->nullable(); // Giao dịch từ tài khoản nào (nếu có)
            $table->string('trx_to')->nullable(); // Giao dịch đến tài khoản nào (nếu có)
            $table->integer('trx_amount'); // Số tiền giao dịch
            $table->integer('trx_balance_available'); // Số dư còn lại sau giao dịch
            $table->string('trx_hash_request')->nullable(); // Hash của yêu cầu giao dịch (dùng cho tracking hoặc xác thực)
            $table->tinyInteger('trx_status')->default(0); // Trạng thái giao dịch: 0-Pending, 1-Completed, 2-Failed
            $table->unsignedBigInteger('withdraw_request_id')->nullable(); // ID của yêu cầu rút tiền (nếu có)
            $table->timestamps(); // Tự động thêm cột 'created_at' và 'updated_
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trx_history');
    }
};
