## Installation

Follow the steps below to install the app

- clone the repository
- composer install
- change file permissions if necessary (775 for folders, 644 for files)
- update the .env variables particularly the `APP_URL`, `CORS_ALLOWED_ORIGINS`, and the DB variables
- run `php artisan migrate`
- run `php artisan passport:client --password` and follow the on screen instructions
- complete

this should cover the API part

## Seeder

Optionally, you can also run the seeder to populate the users table

- run `php artisan db:seed`

## Tests

You can run test using the following command:

- run `php artisan test`