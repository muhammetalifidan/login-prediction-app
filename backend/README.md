# Kullanıcı Oturum Tahmin Sistemi - Backend

Bu dizin, Kullanıcı Oturum Tahmin Sistemi projesinin backend uygulamasını içermektedir. Backend, Laravel kullanılarak geliştirilmiştir ve kullanıcı login verilerini analiz ederek bir sonraki oturum zamanını tahmin etme mantığını barındırır.

**Teknolojiler:**

* PHP
* Laravel

**Kurulum:**

1.  Backend dizinine gidin:
    ```bash
    cd backend
    ```
2.  Composer bağımlılıklarını yükleyin:
    ```bash
    composer install
    ```

**Çalıştırma:**

Projenin backend'ini ayağa kaldırmak için iki farklı yöntem kullanabilirsiniz: Sail (Docker ile) veya yerel PHP sunucusu.

**Sail (Docker ile):**

1.  Sail'i kullanarak Docker konteynerlerini başlatın:
    ```bash
    ./vendor/bin/sail up -d
    ```
2.  Uygulama anahtarını oluşturun:
    ```bash
    ./vendor/bin/sail artisan key:generate
    ```
3.  Veritabanı migration'larını çalıştırın:
    ```bash
    ./vendor/bin/sail artisan migrate
    ```
4.  Login verilerini çekin:
    ```bash
    ./vendor/bin/sail artisan fetch:login-data
    ```

**Docker Olmadan (Yerel PHP Sunucusu):**

1.  Yerel PHP sunucusunu başlatın:
    ```bash
    php artisan serve
    ```
2.  Uygulama anahtarını oluşturun:
    ```bash
    php artisan key:generate
    ```
3.  Veritabanı migration'larını çalıştırın:
    ```bash
    php artisan migrate
    ```
4.  Login verilerini çekin:
    ```bash
    php artisan fetch:login-data
    ```

**API Endpoint:**

Backend uygulaması aşağıdaki tek route üzerinden hizmet vermektedir:

* `GET /api/predictions`: Kullanıcı oturum tahminlerini döndürür.

**Canlı Ortam:**

Backend uygulaması aşağıdaki adreste yayındadır:

* [https://login-prediction-app.onrender.com/api/predictions](https://login-prediction-app.onrender.com/api/predictions)