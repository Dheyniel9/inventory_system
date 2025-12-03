#!/bin/bash

# Enable debugging
set -x
# Exit on any error (but allow some commands to fail gracefully)
set -e

echo "🚀 Starting Laravel deployment on Render..."
echo "PHP Version: $(php --version | head -1)"
echo "Composer Version: $(composer --version 2>/dev/null || echo 'Not available')"
echo "Node Version: $(node --version 2>/dev/null || echo 'Not available')"
echo "Current directory: $(pwd)"
echo "Environment variables:"
env | grep -E '^(APP_|DB_|LOG_|PORT)' || echo "No relevant env vars found"

# Set default port
PORT=${PORT:-8000}
echo "Using port: $PORT"

# Ensure .env exists
if [ ! -f .env ]; then
    echo "Creating .env from .env.example..."
    cp .env.example .env
    echo "✅ .env file created"
else
    echo "✅ .env file already exists"
fi

# Update .env with database credentials if available
if [ ! -z "$DATABASE_URL" ]; then
    echo "📡 Using DATABASE_URL for database connection"
    echo "DATABASE_URL=$DATABASE_URL" >> .env
elif [ ! -z "$DB_HOST" ]; then
    echo "📡 Using individual DB environment variables"
    sed -i "s/^DB_HOST=.*/DB_HOST=$DB_HOST/" .env
    sed -i "s/^DB_PORT=.*/DB_PORT=${DB_PORT:-3306}/" .env
    sed -i "s/^DB_DATABASE=.*/DB_DATABASE=$DB_DATABASE/" .env
    sed -i "s/^DB_USERNAME=.*/DB_USERNAME=$DB_USERNAME/" .env
    sed -i "s/^DB_PASSWORD=.*/DB_PASSWORD=$DB_PASSWORD/" .env
fi

# Create necessary directories
mkdir -p storage/framework/{views,cache,sessions} storage/logs bootstrap/cache
chmod -R 755 storage bootstrap/cache

# Install PHP dependencies
echo "📦 Installing PHP dependencies..."
composer install --no-dev --optimize-autoloader --no-interaction --verbose
echo "✅ PHP dependencies installed"

# Install Node.js dependencies and build assets
echo "📦 Installing Node.js dependencies..."
npm ci --prefer-offline --no-audit
echo "✅ Node.js dependencies installed"

echo "🔨 Building frontend assets..."
npm run build
echo "✅ Frontend assets built"

# Generate application key if not set
echo "🔑 Generating application key..."
php artisan key:generate --force --no-interaction

# Clear and optimize caches
echo "🧹 Clearing and optimizing caches..."
php artisan config:clear || true
php artisan cache:clear || true
php artisan view:clear || true
php artisan route:clear || true

php artisan config:cache || true
php artisan route:cache || true
php artisan view:cache || true

# Create storage symlink
echo "🔗 Creating storage symlink..."
php artisan storage:link || echo "Storage link already exists"

# Test database connection
echo "🔍 Testing database connection..."
php artisan migrate:status || {
    echo "❌ Database connection failed. Checking configuration..."
    php artisan config:show database.connections.mysql || true
    echo "Environment check:"
    php artisan env || true
    exit 1
}
echo "✅ Database connection successful"

# Run database migrations
echo "🗄️ Running database migrations..."
php artisan migrate --force --no-interaction
echo "✅ Migrations completed"

# Seed the database (only if SEED_DATABASE is true)
if [ "$SEED_DATABASE" = "true" ]; then
    echo "🌱 Seeding database..."
    php artisan db:seed --force --no-interaction
    echo "✅ Database seeded"
fi

# Final health check
echo "🏥 Running health check..."
php artisan config:show app.key | head -1 || echo "⚠️ APP_KEY might not be set"

echo "✅ Deployment completed successfully!"
echo "📊 Application status:"
echo "  - PHP Version: $(php --version | head -1)"
echo "  - Laravel Version: $(php artisan --version)"
echo "  - Environment: $(php artisan env)"
echo "  - Debug Mode: $(php artisan tinker --execute='echo config("app.debug") ? "ON" : "OFF";')"

# Start the server with error logging
echo "🚀 Starting server on port $PORT..."
exec php artisan serve --host=0.0.0.0 --port=$PORT
