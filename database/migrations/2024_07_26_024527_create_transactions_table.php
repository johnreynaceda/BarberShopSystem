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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name');
            $table->string('service_name');
            $table->string('barber_name');
            $table->integer('barber_id');
            $table->dateTime('date');
            $table->double('amount');
            $table->string('mode_of_payment');
            $table->string('customer_type');
            $table->double('barber_commission')->default(0);
            $table->double('admin_commission')->default(0);
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
