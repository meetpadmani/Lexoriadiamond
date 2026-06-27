<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('competitor_alerts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('competitor_id')->constrained('competitors')->onDelete('cascade');
            $table->string('alert_type'); // PRICE_DROP, NEW_SALE, NEW_PRODUCTS, FOLLOWER_SPIKE
            $table->text('message');
            $table->boolean('is_read')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('competitor_alerts');
    }
};
