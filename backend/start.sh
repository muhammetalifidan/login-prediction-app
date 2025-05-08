#!/bin/bash

# SQLite dosyası oluştur
if [ ! -f database/database.sqlite ]; then
    mkdir -p database
    touch database/database.sqlite
fi

# Uygulama anahtarı oluştur
php artisan key:generate

# Migration ve özel komut
php artisan migrate --force
php artisan fetch:login-data || true

# Laravel sunucusunu başlat
php artisan serve --host=0.0.0.0 --port=8080
