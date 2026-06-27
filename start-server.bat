@echo off
echo Starting Lexoria Diamond Laravel Server...
set PHPRC=C:\Program Files\php-8.5.7
set PHP_BINARY=C:\Program Files\php-8.5.7\php.exe
"C:\Program Files\php-8.5.7\php.exe" artisan serve --host=0.0.0.0 --port=8080
pause
