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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shop_id');
            $table->foreignId('service_id');
            $table->foreignId('barber_id');
            $table->foreignId('user_id');
            $table->dateTime('date');
            $table->string('mode_of_payment');
            $table->string('status')->default('pending');
            $table->string('customer_type');
            $table->longText('reason_for_cancellation')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
