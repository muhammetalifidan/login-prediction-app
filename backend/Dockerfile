FROM php:8.2-cli

# Gerekli sistem paketleri
RUN apt-get update && apt-get install -y \
    git zip unzip curl libpng-dev libonig-dev libxml2-dev libzip-dev sqlite3 libsqlite3-dev \
    && docker-php-ext-install pdo pdo_sqlite mbstring zip exif pcntl

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Çalışma dizini
WORKDIR /var/www/html

# Proje dosyalarını kopyala
COPY . .

# Laravel bağımlılıkları
RUN composer install --no-dev --optimize-autoloader

# Laravel önbellek ve link işlemleri
RUN php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache && \
    php artisan storage:link || true

# Entrypoint script
COPY start.sh /start.sh
RUN chmod +x /start.sh

# 8080 portu dışa aç
EXPOSE 8080

# Laravel'i başlatmadan önce artisan komutlarını çalıştır
CMD ["/start.sh"]
