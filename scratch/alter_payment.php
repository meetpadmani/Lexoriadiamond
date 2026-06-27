<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

if (!Schema::hasColumn('payment_settings', 'payoneer_client_id')) {
    Schema::table('payment_settings', function (Blueprint $table) {
        $table->string('payoneer_client_id')->nullable();
        $table->string('payoneer_client_secret')->nullable();
    });
    echo "Columns added to payment_settings.\n";
} else {
    echo "Columns already exist.\n";
}
