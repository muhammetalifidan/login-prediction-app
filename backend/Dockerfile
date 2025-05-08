FROM php:8.4-fpm

# Sistem paketleri
RUN apt-get update && apt-get install -y \
    git zip unzip curl libpng-dev libonig-dev libxml2-dev libzip-dev sqlite3 \
    && docker-php-ext-install pdo pdo_sqlite mbstring zip exif pcntl

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Çalışma dizini
WORKDIR /var/www/html

# Uygulama dosyalarını kopyala
COPY . .

# Composer install (production)
RUN composer install --no-dev --optimize-autoloader

# İzinler (gerekirse buraya chown da eklenebilir)
RUN chmod -R 775 storage bootstrap/cache

# Laravel cache işlemleri
RUN php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache && \
    php artisan storage:link || true

# Entrypoint script
COPY start.sh /start.sh
RUN chmod +x /start.sh

EXPOSE 8080

# Sunucuyu başlatmadan önce artisan komutlarını çalıştır
CMD ["/start.sh"]
