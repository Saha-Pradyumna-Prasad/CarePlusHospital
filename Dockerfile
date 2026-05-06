# ফাইলটি ডকার ইমেজ তৈরির নির্দেশনা দেয়
FROM richarvey/nginx-php-fpm:2.1.2

# অ্যাপের ফাইল কন্টেইনারের ভিতরে কপি করে
COPY . .

# লারাভেল অ্যাপের জন্য প্রয়োজনীয় কনফিগারেশন সেট করে
ENV SKIP_COMPOSER 0
ENV WEBROOT /var/www/html/public
ENV PHP_ERRORS_STDERR 1
ENV RUN_SCRIPTS 1
ENV REAL_IP_HEADER 1

# লারাভেলের এনভায়রনমেন্ট ভেরিয়েবল সেট করে
ENV APP_ENV production
ENV APP_DEBUG false

# কম্পোজার সেরা কাজ করার জন্য সুপার ইউজার মোড চালু করে
ENV COMPOSER_ALLOW_SUPERUSER 1

# কন্টেইনার শুরুর সময় যেসব স্ক্রিপ্ট চালাতে হবে তার নির্দেশনা
CMD ["/start.sh"]