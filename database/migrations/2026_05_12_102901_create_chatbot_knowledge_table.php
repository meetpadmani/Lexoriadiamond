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
        Schema::create('chatbot_knowledge', function (Blueprint $table) {
            $table->id();
            $table->string('question'); // Representative question
            $table->text('keywords'); // Comma separated keywords for matching
            $table->text('answer'); // The humanized response
            $table->string('category')->default('General');
            $table->boolean('is_active')->default(true);
            $table->integer('hits')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chatbot_knowledge');
    }
};
