## Inosoft Backend Test by Disa Hagai Tarigan

Installation Guide :

- Run `composer install`
- If you clone from my repository, copy `.env.example` paste on root folder and rename to `.env`
- On the `.env` file change db config with `DB_URI = mongodb+srv://dev:dev123@my-db.4roicuq.mongodb.net/?retryWrites=true&w=majority`
- Run `php artisan key:generate`
- Run `php artisan jwt:secret`
- For the user unit testing run `php artisan test --testsuite=Feature --filter 'UserControllerTest'`
- For the kendaraan unit testing run `php artisan test --testsuite=Feature --filter 'KendaraanControllerTest'`
- For the development server run `php artisan serve`
- Postman link `https://www.getpostman.com/collections/08e60688f5d5b268d81a`

