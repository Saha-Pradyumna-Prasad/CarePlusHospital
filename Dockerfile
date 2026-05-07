FROM serversideup/php:8.4-fpm-nginx

# রুট ইউজার দিয়ে প্রয়োজনীয় কাজ করি
USER root
WORKDIR /var/www/html

# সিস্টেম প্যাকেজ ইনস্টল (পোস্টগ্রেএসক্লায়েন্ট ও জিপ)
RUN apt-get update && apt-get install -y postgresql-client zip unzip && rm -rf /var/lib/apt/lists/*

# পুরো ফোল্ডার কপি করি
COPY --chown=www-data:www-data . .

# একবার www-data ইউজারে সুইচ করি
USER www-data

# সম্পূর্ণ vpn/স্টোরেজ ফোল্ডার তৈরি ও অনুমতি (নতুন)
RUN mkdir -p /var/www/html/storage/framework/sessions \
    && mkdir -p /var/www/html/storage/framework/views \
    && mkdir -p /var/www/html/storage/framework/cache \
    && mkdir -p /var/www/html/storage/logs \
    && mkdir -p /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage \
    && chmod -R 775 /var/www/html/bootstrap/cache

# কম্পোজার ডিপেন্ডেন্সি ইনস্টল
RUN composer install --no-dev --no-interaction --optimize-autoloader

# স্টোরেজ লিংক, ক্যাশ, মাইগ্রেশন (যেকোনো এরে সত্ত্বেও চালু থাকবে)
RUN php artisan storage:link || true
RUN php artisan config:cache || true
RUN php artisan route:cache || true
RUN php artisan view:cache || true
RUN php artisan migrate --force || true

EXPOSE 8080
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8080"]
