# Build stage
FROM php:8.3-fpm as builder

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpq-dev \
    libmcrypt-dev \
    mariadb-client-core \
    nodejs \
    npm \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql

# Install composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

# Copy entire application first
COPY . .

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader --no-scripts

# Install npm dependencies and build assets
RUN npm ci && npm run build

# Production stage
FROM php:8.3-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    curl \
    libpq-dev \
    mariadb-client-core \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql

WORKDIR /app

# Copy application code and vendor from builder
COPY --from=builder /app .

# Create necessary directories with proper permissions
RUN mkdir -p storage/framework/views storage/framework/cache storage/logs \
    && chmod -R 755 storage bootstrap/cache \
    && cp .env.production .env || true

# Expose port
EXPOSE 8000

# Start command
CMD ["sh", "-c", "php artisan key:generate --force 2>/dev/null || true && php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=8000"]
