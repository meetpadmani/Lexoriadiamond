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
        Schema::table('users', function (Blueprint $table) {
            $table->string('crm_role')->nullable()->after('role');
            // crm_role values: admin, sales_manager, sales_executive, cad_designer, client
            $table->string('department')->nullable()->after('crm_role');
            $table->string('avatar')->nullable()->after('department');
            $table->boolean('crm_access')->default(false)->after('avatar');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['crm_role', 'department', 'avatar', 'crm_access']);
        });
    }
};
