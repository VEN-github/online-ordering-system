#!/usr/bin/env bash
echo "Running composer"
composer install --working-dir=/var/www/html

echo "Clearing caches..."
php artisan optimize:clear

echo "Caching routes..."
php artisan route:cache

echo "Running migrations..."
php artisan migrate:fresh --seed --force

echo "done deploying"