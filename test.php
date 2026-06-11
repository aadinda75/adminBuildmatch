<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$p = \App\Models\Profile::first();
if ($p) {
    echo "Found: " . $p->id . "\n";
    $p->is_verified = !$p->is_verified;
    $p->save();
    echo "Saved! New status: " . ($p->is_verified ? 'true' : 'false') . "\n";
} else {
    echo "No profile found\n";
}
