#!/bin/bash

# Exit if any command fails
set -e

# Set permissions (optional on render)
chmod -R 775 storage bootstrap/cache

# Laravel optimization commands
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Run migrations (optional: enable in production if needed)
# php artisan migrate --force

# Start PHP-FPM
php artisan serve --host=0.0.0.0 --port=10000

