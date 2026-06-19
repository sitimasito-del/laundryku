#!/bin/bash

# Pre-warm Laravel caches for faster cold starts
echo "Pre-warming Laravel caches..."

# Generate config cache
php artisan config:cache 2>/dev/null || true

# Generate route cache  
php artisan route:cache 2>/dev/null || true

# Create necessary directories
mkdir -p storage/logs storage/framework/cache storage/framework/sessions bootstrap/cache

# Set permissions
chmod -R 755 storage bootstrap/cache

echo "Cache warming completed!"
