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

# Update .env with Railway database variables if available
if [ ! -z "$MYSQLHOST" ]; then
    echo "Updating database configuration from Railway..."
    sed -i "s/^DB_HOST=.*/DB_HOST=$MYSQLHOST/" .env
    sed -i "s/^DB_PORT=.*/DB_PORT=$MYSQLPORT/" .env
    sed -i "s/^DB_DATABASE=.*/DB_DATABASE=$MYSQL_DATABASE/" .env
    sed -i "s/^DB_USERNAME=.*/DB_USERNAME=$MYSQL_USER/" .env
    sed -i "s/^DB_PASSWORD=.*/DB_PASSWORD=$MYSQL_PASSWORD/" .env
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
echo "Listening on port $PORT - Railway will connect here"
exec php artisan serve --host=0.0.0.0 --port=$PORT
