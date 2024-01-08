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
        Schema::table('orders', function (Blueprint $table) {
            $table->unsignedBigInteger('order_type_id');
            $table->string('order_type'); // this a morph relation
            $table->unsignedBigInteger('payment_methods_id')->nullable();
            $table->foreign('payment_methods_id')->references('id')->on('payment_methods');
            $table->tinyInteger('is_paid')->nullable();
            $table->string('payment_reference')->nullable();
            $table->string('payment_log')->nullable();
            $table->integer('net_paid');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
