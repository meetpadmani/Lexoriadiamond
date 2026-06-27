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
        Schema::table('video_products', function (Blueprint $table) {
            $table->string('slug')->nullable()->after('product_name');
            $table->text('description')->nullable()->after('slug');
            $table->string('image2')->nullable()->after('product_image');
            $table->string('image3')->nullable()->after('image2');
            $table->string('image4')->nullable()->after('image3');
            $table->string('image5')->nullable()->after('image4');
            $table->string('image6')->nullable()->after('image5');
            $table->string('metal_type')->nullable()->after('original_price');
            $table->string('metal_purity')->nullable()->after('metal_type');
            $table->string('weight')->nullable()->after('metal_purity');
            $table->string('sku')->nullable()->after('weight');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('video_products', function (Blueprint $table) {
            //
        });
    }
};
