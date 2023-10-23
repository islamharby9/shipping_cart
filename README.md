## Shopping cart

This only endpoints for backend shopping cart.

## Setup
1. Clone the repo 
2. Change file name .env.example to .env
3. Run composer install
4. Change .env
`` DB_DATABASE=shopping_cart or any name
   DB_USERNAME=root
   DB_PASSWORD=
``
5. Run php artisan key:generate
6. Run php artisan migrate
7. Run php artisan db:seed
8. Run php artisan serve
