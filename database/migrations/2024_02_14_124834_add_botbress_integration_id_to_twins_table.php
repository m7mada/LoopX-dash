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
            $table->string('botbress_integration_key')->nullable();
            $table->string('botbress_workspace_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('twins', function (Blueprint $table) {
            //
        });
    }
};
