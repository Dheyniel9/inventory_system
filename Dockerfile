# Build stage
FROM php:8.3-fpm as builder

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpq-dev \
    libmcrypt-dev \
    mysql-client \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql

# Install composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

# Copy composer files
COPY composer.json composer.lock ./

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Production stage
FROM php:8.3-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    curl \
    libpq-dev \
    mysql-client \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql

# Install Node.js
RUN apt-get update && apt-get install -y nodejs npm && rm -rf /var/lib/apt/lists/*

WORKDIR /app

# Copy application code
COPY . .

# Copy vendor from builder
COPY --from=builder /app/vendor ./vendor

# Install npm dependencies and build assets
RUN npm ci && npm run build

# Create necessary directories
RUN mkdir -p storage/framework/views storage/framework/cache storage/logs \
    && chmod -R 755 storage bootstrap/cache \
    && cp .env.production .env || true

# Expose port
EXPOSE 8000

# Start command
CMD ["sh", "-c", "php artisan key:generate --force 2>/dev/null || true && php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=8000"]
