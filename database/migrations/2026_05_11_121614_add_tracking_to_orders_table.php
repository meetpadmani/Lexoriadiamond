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
        Schema::table('orders', function (Blueprint $table) {
            $table->string('tracking_number')->nullable()->after('status');
            $table->string('courier_name')->nullable()->after('tracking_number');
            $table->decimal('shipping_charges', 10, 2)->default(0)->after('total_amount');
            $table->string('tracking_url')->nullable()->after('courier_name');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['tracking_number', 'courier_name', 'shipping_charges', 'tracking_url']);
        });
    }
};
