#!/usr/bin/env bash
echo "Running composer"
cp /etc/secrets/.env .env
composer global require hirak/prestissimo
composer install --no-dev --working-dir=/var/www/html

echo "Clearing caches..."
php artisan optimize:clear

echo "Caching config..."
php artisan config:cache

echo "Caching routes..."
php artisan route:cache

echo "Running migrations..."optimize
php artisan migrate --force

echo "Running seeders"
php artisan db:seed --class=DatabaseTestSeeder

echo "done deploying"