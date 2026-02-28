<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

#お問い合わせフォーム課題

# 環境構築
    Dockerビルド
    ・git clone git@github.com:Naru412/exam.git
    ・docker-compose up -d --build
    laravel環境構築
    ・docker-compose exec php bash
    ・composer install
    ・cp .env.example .env
    ・php artisan key:generate
    ・php artisan migrate
    ・php artisan db:seed

# 開発環境
    ・お問い合わせ画面　　　http://localhost/
    ・お問い合わせ確認画面　http://localhost/contacts/confirm
    ・サンクス画面　　　　　http://localhost/contacts/store
    ・会員登録画面         http://localhost/register
    ・ログイン画面　　　　　http://localhost/login
    ・管理画面　　　　　　　http://localhost/admin
    ・phpMyAdmin          ocalhost:8080/

# 使用技術
    nginx:1.21.1
    mysql:8.0.26
    PHP 8.1.34     
    Laravel Framework 8.83.29

# ER図
![alt text](images/image-1.png)