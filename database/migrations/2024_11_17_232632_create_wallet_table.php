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
        Schema::create('wallet', function (Blueprint $table) {
            $table->id('wallet_id');
            $table->string('wallet_account_id')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->integer('wallet_balance_available')->default(0);
            $table->integer('wallet_status')->default(0);
            $table->integer('wallet_user_level')->default(0);
            $table->string('wallet_trust_device_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wallet');
    }
};
