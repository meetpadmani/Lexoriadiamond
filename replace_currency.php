<?php
$directories = ['app', 'resources/views', 'config'];
$replacements = [
    '₹' => '$',
    'INR' => 'USD',
    'â‚¹' => '$' // just in case it was saved incorrectly
];

$count = 0;

function replaceInDir($dir, $replacements, &$count) {
    $files = scandir($dir);
    foreach ($files as $file) {
        if ($file === '.' || $file === '..') continue;
        $path = $dir . DIRECTORY_SEPARATOR . $file;
        if (is_dir($path)) {
            replaceInDir($path, $replacements, $count);
        } else {
            $ext = pathinfo($path, PATHINFO_EXTENSION);
            if ($ext === 'php' || $ext === 'blade') {
                $content = file_get_contents($path);
                $original = $content;
                foreach ($replacements as $search => $replace) {
                    $content = str_replace($search, $replace, $content);
                }
                if ($content !== $original) {
                    file_put_contents($path, $content);
                    echo "Updated: $path\n";
                    $count++;
                }
            }
        }
    }
}

foreach ($directories as $dir) {
    if (is_dir($dir)) {
        replaceInDir($dir, $replacements, $count);
    }
}

echo "Total files updated: $count\n";
