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
        Schema::create('packages_prices_discounts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('price_id');
            $table->integer('is_active')->nullable();
            $table->date('start')->nullable();
            $table->date('end')->nullable();   
            $table->integer('discount');
            $table->unsignedBigInteger('type_id');
            $table->foreign('type_id')->references('id')->on('discount_type')->onDelete('cascade');
            $table->foreign('price_id')->references('id')->on('packages_prices')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packages_discounts');
    }
};
