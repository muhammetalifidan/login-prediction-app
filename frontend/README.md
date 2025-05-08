# Kullanıcı Oturum Tahmin Sistemi - Frontend

Bu dizin, Kullanıcı Oturum Tahmin Sistemi projesinin frontend uygulamasını içermektedir. Frontend, React kullanılarak geliştirilmiştir ve backend'den alınan kullanıcı oturum tahminlerini kullanıcı dostu bir arayüzde görüntüler.

**Teknolojiler:**

* React
* npm

**Kurulum:**

1.  Frontend dizinine gidin:
    ```bash
    cd frontend
    ```
2.  npm bağımlılıklarını yükleyin:
    ```bash
    npm install
    ```

**Çalıştırma:**

1.  Uygulamayı geliştirme modunda başlatın:
    ```bash
    npm run dev
    ```
    Bu komut genellikle uygulamayı varsayılan olarak `http://localhost:5174` adresinde başlatır.

**API İletişimi:**

Frontend uygulaması, backend API'sine istek atmak için Axios kullanmaktadır. Tahmin verileri aşağıdaki backend endpoint'inden çekilir:

* [https://login-prediction-app.onrender.com/api/predictions](https://login-prediction-app.onrender.com/api/predictions)

**Canlı Ortam:**

Frontend uygulaması aşağıdaki adreste yayındadır:

* [https://login-prediction.netlify.app/](https://login-prediction.netlify.app/)

**Özellikler:**

* Her kullanıcı için son login zamanını gösterir.
* Her algoritma için tahmin edilen bir sonraki login zamanını karşılaştırmalı bir tablo şeklinde sunar.