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
        Schema::table('payment_settings', function (Blueprint $table) {
            if (!Schema::hasColumn('payment_settings', 'payoneer_client_id')) {
                $table->string('payoneer_client_id')->nullable();
            }
            if (!Schema::hasColumn('payment_settings', 'payoneer_client_secret')) {
                $table->string('payoneer_client_secret')->nullable();
            }
            if (!Schema::hasColumn('payment_settings', 'payoneer_sandbox')) {
                $table->boolean('payoneer_sandbox')->default(true);
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payment_settings', function (Blueprint $table) {
            $table->dropColumn(['payoneer_client_id', 'payoneer_client_secret', 'payoneer_sandbox']);
        });
    }
};
