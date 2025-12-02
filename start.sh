#!/bin/bash
set -e

echo "=== Starting Laravel Application ==="

echo "Step 1: Generating app key..."
php artisan key:generate --force || echo "Key already exists"

echo "Step 2: Running migrations..."
php artisan migrate --force || echo "Migrations failed or already run"

echo "Step 3: Starting Laravel server..."
exec php artisan serve --host=0.0.0.0 --port=${PORT:-8000}
