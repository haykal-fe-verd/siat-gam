#!/bin/sh
set -e

# Install deps kalau belum ada
if [ ! -d "vendor" ]; then
  echo ">> composer install (no dev if APP_ENV=production)"
  if [ "$APP_ENV" = "production" ]; then
    composer install --no-dev --optimize-autoloader
  else
    composer install
  fi
fi

# Permission minimal
mkdir -p storage/framework/{cache,sessions,views} storage/logs bootstrap/cache
chmod -R 777 storage bootstrap/cache || true

# Generate APP_KEY kalau belum
if ! grep -qE '^APP_KEY=base64:' .env 2>/dev/null; then
  echo ">> php artisan key:generate"
  php artisan key:generate || true
fi

# (opsional) migrate
# php artisan migrate --force || true

echo ">> starting php-fpm"
exec php-fpm
