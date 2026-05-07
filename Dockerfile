FROM serversideup/php:8.4-fpm-nginx

USER root

WORKDIR /var/www/html

RUN apt-get update && apt-get install -y postgresql-client zip unzip && rm -rf /var/lib/apt/lists/*

COPY --chown=www-data:www-data . .

USER www-data

# সব storage ফোল্ডার তৈরি এবং permission ঠিক করা
RUN mkdir -p storage/framework/sessions \
    && mkdir -p storage/framework/views \
    && mkdir -p storage/framework/cache \
    && mkdir -p storage/logs \
    && mkdir -p bootstrap/cache \
    && chmod -R 775 storage \
    && chmod -R 775 bootstrap/cache

RUN composer install --no-dev --no-interaction --optimize-autoloader

RUN php artisan storage:link || true
RUN php artisan migrate --force || true

EXPOSE 8080

CMD ["sh", "-c", "php artisan config:cache && php artisan route:cache && php artisan serve --host=0.0.0.0 --port=8080"]
