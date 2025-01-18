# eSprzedaż - recruitment task

## Main tools

- PHP
- Laravel
- [Docker / Laravel Sail](https://laravel.com/docs/11.x/sail)
- [Swagger API](https://petstore.swagger.io/)

## Requirements

1. PHP
2. Composer
3. Docker

## Installation

WARNING! You must have free port 80.

Run the following commands:

1. Clone repository

```sh
git clone https://github.com/Wojtazzzz/esprzedaz-laravel.git esprzedaz-laravel
```

2. Install dependencies

```sh
cd esprzedaz-laravel && composer install
```

3. Setup env variables

```sh
cp .env.example .env
```

4. Run Docker containers

```sh
./vendor/bin/sail up
```

5. Setup app key

```sh
./vendor/bin/sail artisan key:generate
```

6. Run migrations

```sh
./vendor/bin/sail artisan migrate
```

7. Setup frontend

```sh
./vendor/bin/sail npm i && ./vendor/bin/sail npm run dev
```

7. Build frontend

```sh
./vendor/bin/sail npm run build
```

5. App is available at http://localhost/

You can browse following paths:
\
http://localhost/pets/create
\
http://localhost/pets/show
\
http://localhost/pets/{:id}/edit
