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
        Schema::create('trx_history_detail', function (Blueprint $table) {
            $table->id('trx_history_detail_id'); // ID chi tiết giao dịch
            $table->unsignedBigInteger('trx_id'); // ID giao dịch chính
            $table->text('trx_detail_desc')->nullable(); // Mô tả chi tiết giao dịch
            $table->date('trx_date_issue'); // Ngày phát hành giao dịch
            $table->string('vnp_BankTranNo')->nullable(); // Mã giao dịch ngân hàng (VNPay)
            $table->string('vnp_SecureHash')->nullable(); // Hash bảo mật (VNPay)
            $table->string('vnp_ResponseCode')->nullable(); // Mã phản hồi (VNPay)
            $table->string('vnp_TxnRef')->nullable(); // Mã tham chiếu giao dịch (VNPay)
            $table->string('vnp_TransactionNo')->nullable(); // Mã giao dịch (VNPay)
            $table->date('vnp_PayDate')->nullable(); // Ngày thanh toán (VNPay)
            $table->string('vnp_CardType')->nullable(); // Loại thẻ
            $table->string('BankCode')->nullable(); // Mã ngân hàng
            $table->string('charge_id')->nullable(); // ID thanh toán (Stripe)
            // Liên kết khóa ngoại
            $table->foreign('trx_id')->references('trx_id')->on('trx_history')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trx_history_detail');
    }
};
