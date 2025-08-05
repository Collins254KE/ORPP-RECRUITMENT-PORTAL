#!/bin/bash

# Clear previous cache and views
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

# Run migrations and symlink storage
php artisan migrate --force
php artisan storage:link

# Cache config for production
php artisan config:cache

# Start Laravel
php artisan serve --host 0.0.0.0 --port 10000
