<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$collections = \App\Models\Collection::whereNull('slug')->orWhere('slug', '')->get();
foreach ($collections as $c) {
    if (empty($c->slug)) {
        $c->slug = \Illuminate\Support\Str::slug($c->title);
        $c->save();
    }
}
echo "Done";
