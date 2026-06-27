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
        Schema::create('typography_settings', function (Blueprint $table) {
            $table->id();
            $table->string('heading_font_family')->default('Playfair Display');
            $table->string('heading_font_url')->nullable();
            $table->string('body_font_family')->default('Poppins');
            $table->string('body_font_url')->nullable();
            $table->string('accent_color')->default('#c7a17a');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('typography_settings');
    }
};
