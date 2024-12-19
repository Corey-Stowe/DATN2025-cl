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
        Schema::create('user_wallet_detail', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->longText('id_card_image_front')->nullable();
            $table->longText('id_card_image_back')->nullable();
            $table->longText('id_card_face')->nullable();
            $table->text('id_number')->nullable();
            $table->string('frist_name')->nullable();
            $table->string('last_name')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('nationality')->nullable();
            $table->string('place_of_residence')->nullable();
            $table->string('place_of_birth')->nullable();
            $table->date('issue_date')->nullable();
            $table->date('date_of_expiry')->nullable();
            $table->string('place_of_issue')->nullable();
            $table->string('phone_number')->nullable();
            // Đặt giá trị mặc định hợp lệ hoặc để nullable
            $table->enum('gender', ['MALE', 'FEMALE'])->nullable(); // hoặc ->default('MALE')
            $table->enum('status', ['PENDING_FILLED', 'COMPLETED', 'APROVED', 'REJECTED', 'PENDING_APROVED','COMPLETED_BASIC'])->default('PENDING_FILLED');
            $table->enum('fillstep', ['ADDRESS', 'EKYC', 'TOS', 'COMPLETED'])->default('ADDRESS');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_wallet_detail');
    }
};
