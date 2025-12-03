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

# Copy composer files first for better caching
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-scripts

# Copy npm files
COPY package.json package-lock.json ./
RUN npm ci --legacy-peer-deps --prefer-offline --no-audit

# Copy rest of application
COPY . .

# Build assets
RUN npm run build

# Production stage
FROM php:8.3-fpm

# Install system dependencies including bash, Node.js, and other tools
RUN apt-get update && apt-get install -y \
    bash \
    curl \
    git \
    unzip \
    libpq-dev \
    mariadb-client-core \
    nodejs \
    npm \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql

# Install composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

# Copy application code and vendor from builder
COPY --from=builder /app .

# Ensure .env file exists
RUN if [ ! -f .env ]; then cp .env.production .env 2>/dev/null || echo "APP_KEY=" >> .env; fi

# Create necessary directories with proper permissions
RUN mkdir -p storage/framework/views storage/framework/cache storage/logs \
    && chmod -R 755 storage bootstrap/cache

# Copy startup scripts
COPY start.sh /app/start.sh
COPY render-start.sh /app/render-start.sh
COPY render-simple-start.sh /app/render-simple-start.sh
RUN chmod +x /app/start.sh /app/render-start.sh /app/render-simple-start.sh

# Expose port
EXPOSE 8000

# Set environment variables for Laravel
ENV APP_ENV=production \
    LOG_CHANNEL=stderr \
    APP_DEBUG=false

# Start command (using simple startup script)
CMD ["/app/render-simple-start.sh"]
