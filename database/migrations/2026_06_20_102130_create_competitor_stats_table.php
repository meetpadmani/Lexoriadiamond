<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('competitor_stats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('competitor_id')->constrained('competitors')->onDelete('cascade');
            $table->integer('ig_followers')->default(0);
            $table->decimal('avg_rating', 3, 2)->default(0);
            $table->integer('review_count')->default(0);
            $table->integer('new_products_count')->default(0);
            $table->timestamp('last_scraped_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('competitor_stats');
    }
};
