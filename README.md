# SanDauGiaWeb
HỆ THỐNG WEBSITE SÀN ĐẤU GIÁ ONLINE (05-12-2022)

HOW TO RUN THE CODE
- git clone https://github.com/KaitorNguyen/SanDauGiaWeb.git
- cd sandaugia_laravel
- cp .env.example .env
- Open .env and update DB_DATABASE
- Create database same name as DB_DATABASE and import file "daugiadb.sql" by accessing the link "localhost/phpmyadmin/"
- Run: composer install
- Run: php artisan key:generate
- Run: php artisan serve
