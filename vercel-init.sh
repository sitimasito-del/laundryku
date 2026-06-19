#!/bin/bash

# Create necessary directories for Vercel
mkdir -p storage/app/public
mkdir -p storage/framework/cache
mkdir -p storage/framework/sessions  
mkdir -p storage/framework/views
mkdir -p storage/logs
mkdir -p bootstrap/cache

# Clear cache to force refresh
rm -f bootstrap/cache/packages.php
rm -f bootstrap/cache/services.php
rm -f bootstrap/cache/config.php
rm -f bootstrap/cache/routes-v*.php

# Set permissions
chmod -R 777 storage
chmod -R 777 bootstrap/cache

echo "Directories initialized for Vercel"
