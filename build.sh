#!/bin/bash

echo "Installing dependencies..."
composer install --no-dev --optimize-autoloader

echo "Generating Laravel configuration cache..."
php artisan config:cache

echo "Generating Laravel route cache..."
php artisan route:cache

echo "Setting storage permissions..."
chmod -R 755 storage
chmod -R 755 bootstrap/cache

echo "Build completed!"
