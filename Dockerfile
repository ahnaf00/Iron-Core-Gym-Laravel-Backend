# ── Stage 1: Install Composer dependencies ──────────────────────
FROM composer:2 AS vendor

WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install \
    --no-dev \
    --no-interaction \
    --no-scripts \
    --prefer-dist \
    --optimize-autoloader

# ── Stage 2: Production image ───────────────────────────────────
FROM php:8.4-cli

# Install system deps + PHP extensions
RUN apt-get update && apt-get install -y --no-install-recommends \
        libpng-dev \
        libjpeg-dev \
        libfreetype6-dev \
        libonig-dev \
        libzip-dev \
        unzip \
        curl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install \
        pdo_mysql \
        mbstring \
        gd \
        zip \
        bcmath \
        pcntl \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

WORKDIR /var/www/html

# Copy Composer deps from builder stage
COPY --from=vendor /app/vendor ./vendor

# Copy application code
COPY . .

# Create required directories
RUN mkdir -p storage/framework/cache/data storage/framework/sessions \
        storage/framework/testing storage/framework/views \
        storage/logs storage/app/public bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache \
    && php artisan package:discover --ansi

# No .env and no config cache are baked in: all settings (APP_KEY, DB_*, ...)
# come from the container's environment variables at start-up.
ENV APP_ENV=production \
    APP_DEBUG=false \
    LOG_CHANNEL=stderr \
    PHP_CLI_SERVER_WORKERS=4

EXPOSE 8000

# Cache config from the real environment, link uploads into public/, then serve.
# Migrations run only when RUN_MIGRATIONS=true; seeding is always a manual,
# one-time step:  php artisan db:seed --force
CMD ["sh", "-c", "php artisan config:cache && php artisan route:cache && php artisan storage:link --force && if [ \"$RUN_MIGRATIONS\" = \"true\" ]; then php artisan migrate --force || exit 1; fi && exec php artisan serve --host=0.0.0.0 --port=8000 --no-reload"]
