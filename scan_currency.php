<?php
$directories = ['app', 'resources/views', 'config'];
$patterns = ['/₹/u', '/\bINR\b/'];
$results = [];

function scanDirRecursive($dir, $patterns, &$results) {
    $files = scandir($dir);
    foreach ($files as $file) {
        if ($file === '.' || $file === '..') continue;
        $path = $dir . DIRECTORY_SEPARATOR . $file;
        if (is_dir($path)) {
            scanDirRecursive($path, $patterns, $results);
        } else {
            if (pathinfo($path, PATHINFO_EXTENSION) === 'php') {
                $content = file_get_contents($path);
                foreach ($patterns as $pattern) {
                    if (preg_match($pattern, $content)) {
                        $results[] = $path;
                        break;
                    }
                }
            }
        }
    }
}

foreach ($directories as $dir) {
    if (is_dir($dir)) {
        scanDirRecursive($dir, $patterns, $results);
    }
}

echo implode("\n", $results);
