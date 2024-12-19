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
        Schema::create('user_wallet_logging', function (Blueprint $table) {
            $table->id('event_id'); // ID sự kiện
            $table->unsignedBigInteger('user_id'); // ID người dùng
            $table->string('user_action'); // Hành động của người dùng (deposit, withdraw, transfer)
            $table->string('action_status'); // Trạng thái hành động (success, failed, etc.)
            $table->ipAddress('user_ip')->nullable(); // Địa chỉ IP của người dùng
            $table->integer('amount'); // Số tiền liên quan
            $table->string('user_payment_method')->nullable(); // Phương thức thanh toán (VNPay, Stripe, etc.)
            $table->string('vnp_BankTranNo')->nullable(); // Mã giao dịch ngân hàng (VNPay)
            $table->string('vnp_SecureHash')->nullable(); // Hash bảo mật (VNPay)
            $table->string('vnp_ResponseCode')->nullable(); // Mã phản hồi (VNPay)
            $table->string('payment_method')->nullable(); // Phương thức thanh toán (thẻ, ví, etc.)
            $table->string('last4')->nullable(); // 4 chữ số cuối của thẻ (Stripe)
            $table->string('brand')->nullable(); // Thương hiệu thẻ (Visa, Mastercard)
            $table->date('date_issuing')->nullable(); // Ngày phát hành giao dịch
            $table->timestamps();

            // Liên kết khóa ngoại nếu cần
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('_user_wallet_logging');
    }
};
