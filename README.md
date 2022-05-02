# GoDex API

Api for the GoDex app.

## Demo

https://godex.takaworx.com

## Installation

Follow the steps below to install the app

- clone the repository
- change file permissions (775 for folders, 644 for files)
- composer install
- update the .env variables particularly the `APP_URL`, `CORS_ALLOWED_ORIGINS`, and the DB variables
- run `php artisan migrate`
- run `php artisan passport:keys`
- run `php artisan passport:client --password` and follow the on screen instructions
- complete

this should cover the API part

## Seeder

Optionally, you can also run the seeder to populate the users table

- run `php artisan db:seed`

## Tests

You can run test using the following command:

- run `php artisan test`