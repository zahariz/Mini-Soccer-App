# Mini Soccer App

Aplikasi sederhana Sepak Bola.

## Persyaratan Sistem

Pastikan sistem Anda memenuhi persyaratan berikut sebelum menginstal project:

- [PHP](https://www.php.net/) versi 7.4 atau lebih tinggi
- [Composer](https://getcomposer.org/)
- [Node.js](https://nodejs.org/) dan [NPM](https://www.npmjs.com/) (Opsional, tergantung pada kebutuhan proyek)
- [MySQL](https://www.mysql.com/) atau database lainnya yang didukung oleh Laravel

## Instalasi

Berikut langkah-langkah untuk menginstal project:

1. **Clone Repository**

    ```bash
    git clone <URL_Repository> nama_folder
    ```

2. **Pindah ke Direktori Project**

    ```bash
    cd nama_folder
    ```

3. **Instal Dependensi PHP**

    ```bash
    composer install
    ```

4. **Buat Salinan dari .env**

    ```bash
    cp .env.example .env
    ```

5. **Konfigurasi .env**

    Sesuaikan pengaturan database dan pengaturan lain yang diperlukan dalam file `.env`.

6. **Buat Aplikasi Kunci Laravel**

    ```bash
    php artisan key:generate
    ```

7. **Jalankan Migrasi dan Seeder**

    ```bash
    php artisan migrate --seed
    ```

8. **Jalankan Server Lokal**

    ```bash
    php artisan serve
    ```

    Akses aplikasi di [http://localhost:8000](http://localhost:8000) dalam browser Anda.
    User Login
    Email : admin@gmail.com
    Password : rahasiacuy

    Apabila belum terigestrasi pastikan User sudah di seeder
    ```bash
    php artisan db:seed
    ```


## Lisensi

Diberikan di bawah [Lisensi MIT](LICENSE).
