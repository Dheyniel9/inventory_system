#!/bin/bash

# Simple startup script for pre-built Laravel application
# This assumes dependencies are already installed and assets are built

set -e

echo "🚀 Starting Laravel application on Render..."

# Set default port
PORT=${PORT:-8000}
echo "Using port: $PORT"

# Check if we're in the right directory
if [ ! -f "artisan" ]; then
    echo "❌ Laravel artisan file not found. Current directory: $(pwd)"
    ls -la
    exit 1
fi

echo "✅ Laravel application detected"

# Ensure .env exists
if [ ! -f .env ]; then
    echo "Creating .env from .env.example..."
    cp .env.example .env
    echo "✅ .env file created"
else
    echo "✅ .env file already exists"
fi

# Create necessary directories with proper permissions
echo "📁 Setting up directories and permissions..."
mkdir -p storage/framework/{views,cache,sessions} storage/logs bootstrap/cache
chmod -R 755 storage bootstrap/cache
echo "✅ Directories and permissions set"

# Generate application key if not set
echo "🔑 Checking application key..."
if ! php artisan key:generate --force --no-interaction --show > /dev/null 2>&1; then
    echo "Generating new application key..."
    php artisan key:generate --force --no-interaction
fi
echo "✅ Application key ready"

# Clear any existing caches
echo "🧹 Clearing caches..."
php artisan config:clear 2>/dev/null || true
php artisan cache:clear 2>/dev/null || true
php artisan view:clear 2>/dev/null || true
php artisan route:clear 2>/dev/null || true
echo "✅ Caches cleared"

# Test database connection before running migrations
echo "🔍 Testing database connection..."
if ! php artisan migrate:status > /dev/null 2>&1; then
    echo "❌ Database connection failed. Check your database configuration."
    echo "Database environment variables:"
    env | grep -E '^DB_' || echo "No DB_ environment variables found"
    echo ""
    echo "Attempting to show current database config:"
    php artisan tinker --execute="
        try {
            \$config = config('database.connections.mysql');
            echo 'Host: ' . (\$config['host'] ?? 'not set') . PHP_EOL;
            echo 'Port: ' . (\$config['port'] ?? 'not set') . PHP_EOL; 
            echo 'Database: ' . (\$config['database'] ?? 'not set') . PHP_EOL;
            echo 'Username: ' . (\$config['username'] ?? 'not set') . PHP_EOL;
            echo 'Password: ' . (empty(\$config['password']) ? 'not set' : 'set') . PHP_EOL;
        } catch (Exception \$e) {
            echo 'Error getting config: ' . \$e->getMessage() . PHP_EOL;
        }
    " 2>/dev/null || echo "Could not retrieve database config"
    exit 1
fi
echo "✅ Database connection successful"

# Run database migrations
echo "🗄️ Running database migrations..."
php artisan migrate --force --no-interaction
echo "✅ Migrations completed"

# Seed the database if requested
if [ "$SEED_DATABASE" = "true" ]; then
    echo "🌱 Seeding database..."
    php artisan db:seed --force --no-interaction
    echo "✅ Database seeded"
else
    echo "ℹ️ Database seeding skipped (SEED_DATABASE not set to true)"
fi

# Create storage symlink if needed
echo "🔗 Creating storage symlink..."
php artisan storage:link 2>/dev/null || echo "Storage link already exists or failed"

# Cache configurations for production
echo "⚡ Caching configurations..."
php artisan config:cache 2>/dev/null || echo "Config cache failed"
php artisan route:cache 2>/dev/null || echo "Route cache failed"  
php artisan view:cache 2>/dev/null || echo "View cache failed"
echo "✅ Configurations cached"

# Final health check
echo "🏥 Running final health check..."
echo "  - PHP Version: $(php --version | head -1)"
echo "  - Laravel Version: $(php artisan --version)"
echo "  - Environment: $(php artisan env)"
echo "  - Debug Mode: $(php artisan tinker --execute='echo config("app.debug") ? "ON" : "OFF";' 2>/dev/null || echo 'Unknown')"
echo "  - App Key: $(php artisan tinker --execute='echo config("app.key") ? "SET" : "NOT SET";' 2>/dev/null || echo 'Unknown')"

echo ""
echo "✅ Application ready!"
echo "🚀 Starting Laravel server on 0.0.0.0:$PORT..."

# Start the application server
exec php artisan serve --host=0.0.0.0 --port=$PORT