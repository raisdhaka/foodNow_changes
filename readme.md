# FoodTiger | QR SaaS | WhatsApp | LionPOS

[![FT](https://i.imgur.com/gcgJEb2.jpg)](https://codecanyon.net/user/mobidonia/portfolio)
[![QR](https://i.imgur.com/bqpWgnU.jpg)](https://codecanyon.net/user/mobidonia/portfolio)
[![WP](https://i.imgur.com/VgHDizv.jpg)](https://codecanyon.net/user/mobidonia/portfolio)


## Test
php artisan test --testsuite=Feature

## License

The Laravel framework is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## ENV
SHOW_DEMO_CREDENTIALS=true
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=laravel
DB_PASSWORD=laravel


MAIL_MAILER=smtp
MAIL_HOST=mailhog
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=
MAIL_FROM_ADDRESS='test@example.com'
MAIL_FROM_NAME='App Demo'

## Updates

git diff --name-only faa955eda7f2f5e33aef76e51e5acc9dd9b2c12e > .diff-files.txt && npm run zipjustupdate

COMPOSER_MEMORY_LIMIT=-1 composer require */**

## Clearing cache
php artisan cache:clear
ddcache
php artisan config:cache
php artisan config:clear
php artisan route:clear
php artisan config:cache
php artisan route:cache
php artisan optimize

## Create new module
php artisan module:make Fields
php artisan module:make-migration create_fields_table fields
https://github.com/akaunting/laravel-module

## Zip withoit mac
zip -r es_lang.zip . -x ".*" -x "__MACOSX"

## Sync missing keys
php artisan translation:sync-missing-translation-keys


## Default .env
[.env](https://paste.laravel.io/2fe670c7-f66b-443e-9e79-b5fa6618360b)