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
        Schema::create('customer_support_detail', function (Blueprint $table) {
            $table->id('ticket_detail_id');
            $table->unsignedBigInteger('ticket_id');
            $table->foreign('ticket_id')->references('ticket_id')->on('customer_supports');
            $table->text('ticket_reply');
            $table->string('ticket_reply_attachment',255)->nullable();
            $table->string('ticket_reply_by',255);
            $table->timestamp('ticket_reply_date');
            $table->tinyInteger('ticket_auto_reply_ai')->default(0);//1 true, 0 false
            $table->tinyInteger('mark_as_spam')->default(0);//1 true, 0 false
            //chỗ này không thấy mã nhân viên nào thì không thể chỉ định col employee_id
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_support_detail');
    }
};
