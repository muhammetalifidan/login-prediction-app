#!/bin/bash

# Uygulama anahtarı oluştur
php artisan key:generate

# SQLite dosyasını oluştur
if [ ! -f database/database.sqlite ]; then
    touch database/database.sqlite
fi

# Migration ve özel komut
php artisan migrate --force
php artisan fetch:login-data

# Laravel sunucusunu başlat
php artisan serve --host=0.0.0.0 --port=8080
