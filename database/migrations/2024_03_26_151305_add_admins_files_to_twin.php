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
        Schema::table('twins', function (Blueprint $table) {
            $table->text("integrations_settings")->nullable();
            $table->text("custom_settings")->nullable();
            $table->text("handover_settings")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('twin', function (Blueprint $table) {
            //
        });
    }
};
