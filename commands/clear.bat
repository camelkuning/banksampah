@echo off
cd..
php artisan route:cache
php artisan cache:clear
php artisan config:cache
php artisan config:clear
php artisan view:clear
php artisan optimize