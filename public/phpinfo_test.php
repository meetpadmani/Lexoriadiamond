<?php
echo "PHP Version: " . PHP_VERSION . "\n";
echo "PHP Binary: " . PHP_BINARY . "\n";
echo "mbstring: " . (extension_loaded('mbstring') ? 'LOADED' : 'MISSING') . "\n";
echo "pdo_mysql: " . (extension_loaded('pdo_mysql') ? 'LOADED' : 'MISSING') . "\n";
echo "openssl: " . (extension_loaded('openssl') ? 'LOADED' : 'MISSING') . "\n";
echo "Loaded ini: " . php_ini_loaded_file() . "\n";
echo "PATH: " . getenv('PATH') . "\n";
