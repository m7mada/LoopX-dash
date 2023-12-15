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
        Schema::create('twins', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->text("title");
            $table->rememberToken("qdrant_db")->nullable();
            $table->tinyInteger("is_active")->nullable();
            $table->text("agent_persona")->nullable();
            $table->text("agent_instructions")->nullable();
            $table->text("example_messagesa")->nullable();
            $table->text("kb_model_name")->nullable();
            $table->text("msgs_model_name")->nullable();
            $table->text("agent_dialect")->nullable();
            $table->text("user_dialect")->nullable();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                    ->references('id')
                    ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('twins');
    }
};
