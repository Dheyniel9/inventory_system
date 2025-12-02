#!/bin/sh
set -e

echo "Starting Laravel application..."

# Generate app key if missing
echo "Generating app key..."
php artisan key:generate --force 2>/dev/null || true

# Run migrations
echo "Running database migrations..."
php artisan migrate --force 2>/dev/null || true

# Start the application server
echo "Starting server on 0.0.0.0:8000..."
php artisan serve --host=0.0.0.0 --port=8000
