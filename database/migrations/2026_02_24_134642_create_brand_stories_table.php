<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('brand_stories', function (Blueprint $table) {
            $table->id();
            $table->string('subtitle')->nullable();
            $table->string('title');
            $table->text('content');
            $table->string('image')->nullable();
            $table->string('stat_1_num')->nullable();
            $table->string('stat_1_label')->nullable();
            $table->string('stat_2_num')->nullable();
            $table->string('stat_2_label')->nullable();
            $table->string('button_text')->default('Our Philosophy');
            $table->string('button_link')->default('#');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('brand_stories');
    }
};
