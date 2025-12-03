#!/bin/bash
set -e

PORT=${PORT:-8000}
echo "=== Starting Laravel Application ==="
echo "Port: $PORT"

# Ensure .env exists
if [ ! -f .env ]; then
    echo "Creating .env from .env.production..."
    cp .env.production .env 2>/dev/null || {
        echo "APP_KEY=" > .env
        echo "APP_NAME=Inventory" >> .env
        echo "APP_ENV=production" >> .env
    }
fi

# Create necessary directories
mkdir -p storage/framework/views storage/framework/cache storage/logs
chmod -R 755 storage bootstrap/cache

echo "Step 1: Generating app key..."
php artisan key:generate --force || echo "Key already exists"

echo "Step 2: Running migrations..."
php artisan migrate --force 2>&1 || echo "Migrations skipped or failed (may already be run)"

echo "Step 3: Clearing caches..."
php artisan config:cache 2>/dev/null || true
php artisan route:cache 2>/dev/null || true
php artisan view:cache 2>/dev/null || true

echo "Step 4: Starting Laravel server on 0.0.0.0:$PORT..."
exec php artisan serve --host=0.0.0.0 --port=$PORT
