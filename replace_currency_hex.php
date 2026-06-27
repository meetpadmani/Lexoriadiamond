<?php
$directories = ['app', 'resources/views', 'config'];

// \xE2\x82\xB9 is the UTF-8 hex encoding for ₹
$searchBytes = "\xE2\x82\xB9";
$replaceStr = "$";
$searchInr = "INR";
$replaceUsd = "USD";

$count = 0;

function replaceInDir($dir, $searchBytes, $replaceStr, $searchInr, $replaceUsd, &$count) {
    $files = scandir($dir);
    foreach ($files as $file) {
        if ($file === '.' || $file === '..') continue;
        $path = $dir . DIRECTORY_SEPARATOR . $file;
        if (is_dir($path)) {
            replaceInDir($path, $searchBytes, $replaceStr, $searchInr, $replaceUsd, $count);
        } else {
            $ext = pathinfo($path, PATHINFO_EXTENSION);
            if ($ext === 'php' || $ext === 'blade') {
                $content = file_get_contents($path);
                $original = $content;
                
                $content = str_replace($searchBytes, $replaceStr, $content);
                $content = str_replace($searchInr, $replaceUsd, $content);
                
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
        replaceInDir($dir, $searchBytes, $replaceStr, $searchInr, $replaceUsd, $count);
    }
}

echo "Total files updated: $count\n";
