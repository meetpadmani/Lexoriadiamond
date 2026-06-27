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
        Schema::create('video_products', function (Blueprint $table) {
            $table->id();
            $table->string('video_path')->nullable();
            $table->string('product_image')->nullable();
            $table->string('product_name')->nullable();
            $table->decimal('current_price', 10, 2)->nullable();
            $table->decimal('original_price', 10, 2)->nullable();
            $table->string('views')->default('0');
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('video_products');
    }
};
