#!/bin/sh

set -e

# Generate app key if missing
if [ ! -f storage/oauth-private.key ]; then
  echo "Running Laravel setup..."
  php artisan key:generate --force
  php artisan config:cache
  php artisan route:cache
  php artisan view:cache
fi

exec php-fpm
