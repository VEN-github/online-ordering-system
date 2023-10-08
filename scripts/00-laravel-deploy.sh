#!/usr/bin/env bash
echo "Running composer"
composer install --working-dir=/var/www/html

echo "Clearing caches..."
php artisan optimize:clear

echo "Caching routes..."
php artisan route:cache

echo "Running migrations..."
php artisan migrate:fresh --seed --force

echo "Storage link..."
sudo chmod -R 777 storage
php artisan storage:link --force

echo "done deploying"