# PHP 8.4 with FPM & Nginx
FROM serversideup/php:8.4-fpm-nginx

USER root

WORKDIR /var/www/html

# সব ফাইল কপি
COPY . .

# ফোল্ডার তৈরি করুন (যদি না থাকে)
RUN mkdir -p /var/www/html/storage /var/www/html/bootstrap/cache

# পারমিশন সেট
RUN chmod -R 755 /var/www/html/storage \
    && chmod -R 755 /var/www/html/bootstrap/cache

# PostgreSQL client
RUN apt-get update && apt-get install -y postgresql-client && rm -rf /var/lib/apt/lists/*

USER www-data

# কম্পোজার ডিপেন্ডেন্সি ইনস্টল
RUN composer install --no-dev --no-interaction --optimize-autoloader

# ক্যাশ প্রি-রান
RUN php artisan config:cache \
    && php artisan route:cache \
    && php artisan view:cache

EXPOSE 8080

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8080"]
