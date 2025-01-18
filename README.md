# eSprzedaż - recruitment task

## Main tools

- PHP
- Laravel
- [Docker / Laravel Sail](https://laravel.com/docs/11.x/sail)
- [Swagger API](https://petstore.swagger.io/)

## Requirements

1. PHP
2. Docker

## Installation

Run the following commands:

1. Clone repository

```sh
git clone https://github.com/Wojtazzzz/esprzedaz-laravel.git esprzedaz-laravel && cd esprzedaz-laravel
```

2. Setup Docker containers

```sh
./vendor/bin/sail up
```

3. Run migrations

```sh
./vendor/bin/sail artisan migrate
```

4. Build frontend

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
