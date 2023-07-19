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
        Schema::create('payment_logs', function (Blueprint $table) {
            $table->id();
            $table->string('session_id')->nullable();
            $table->bigInteger('transaction_id')->nullable();
            $table->string('reference_id')->nullable();
            $table->string('via')->nullable();
            $table->string('channel')->nullable();
            $table->string('payment_no')->nullable();
            $table->string('payment_name')->nullable();
            $table->float('subtotal')->nullable();
            $table->float('fee')->nullable();
            $table->float('total')->nullable();
            $table->string('fee_direction')->nullable();
            $table->json('log_json')->nullable();
            $table->string('expired_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_logs');
    }
};
