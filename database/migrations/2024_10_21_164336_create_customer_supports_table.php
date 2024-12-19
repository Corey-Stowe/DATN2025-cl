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
        Schema::create('customer_supports', function (Blueprint $table) {
            $table->id('ticket_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('ticket_title',255);
            $table->text('ticket_content');
             $table->tinyInteger('ticket_status')->default(1);
            $table->tinyInteger('ticket_priority')->default(1);
            $table->string('ticket_category',255);
            $table->string('ticket_attachment',255)->nullable();
            $table->text('ticket_ai_analyze')->nullable();
            $table->timestamp('ticket_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_supports');
    }
};
