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
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table -> string('name')->nullable();
            $table -> string('path')->nullable();
            $table -> string('type')->nullable();
            $table -> string('size')->nullable();
            $table -> string('extension')->nullable();
            $table -> foreignId('twin_id')->constrained('twins')->onDelete('cascade');
            $table -> timestamps();
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
