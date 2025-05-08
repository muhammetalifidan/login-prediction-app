FROM php:8.4-fpm

# Gerekli sistem paketleri
RUN apt-get update && apt-get install -y \
    git zip unzip curl libpng-dev libonig-dev libxml2-dev libzip-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring zip exif pcntl

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Uygulama dizini
WORKDIR /var/www/html

# Proje dosyalarını kopyala
COPY . .

# Composer install (geliştirme dışı)
RUN composer install --no-dev --optimize-autoloader

# Laravel izinleri ve cache işlemleri
RUN php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache && \
    php artisan storage:link || true

# 8080 portunu expose et
EXPOSE 8080

# Laravel server başlat
CMD php artisan serve --host=0.0.0.0 --port=8080
