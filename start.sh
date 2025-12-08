#!/bin/bash
set -e

echo "Running database migrations..."
php artisan migrate --force

echo "Clearing caches..."
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

echo "Starting application..."
exec php artisan serve --host=0.0.0.0 --port=${PORT:-8080}
