# PHP 8.4 with FPM & Nginx
FROM serversideup/php:8.4-fpm-nginx

USER root

WORKDIR /var/www/html

# System dependencies
RUN apt-get update && apt-get install -y \
    postgresql-client \
    zip \
    unzip \
    git \
    curl \
    && rm -rf /var/lib/apt/lists/*

# Copy application files
COPY --chown=www-data:www-data . .

# Create necessary directories
RUN mkdir -p /var/www/html/storage/framework/{sessions,views,cache} \
    && mkdir -p /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage \
    && chmod -R 775 /var/www/html/bootstrap/cache

USER www-data

# Install Composer dependencies
RUN composer install --no-dev --no-interaction --optimize-autoloader --ignore-platform-req=ext-pcntl --ignore-platform-req=ext-posix

# Clear and cache configs (with error suppression)
RUN php artisan config:clear || true
RUN php artisan cache:clear || true

# Create storage link and run migrations
RUN php artisan storage:link || true
RUN php artisan migrate --force || true

EXPOSE 8080

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8080"]
