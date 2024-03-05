# Larabee

A simple, lightweight, and open source Google Analytics alternative based on Laravel.

![Screenshot 2024-03-05 at 3 27 28 PM](https://github.com/LarabeeHQ/larabee/assets/265964/4190250c-0326-42db-8cfa-2c2ed0d275c1)

## Development

### Running Docker (Sail) Locally
The docker-compose contains all what you need to run Larabee on your localhost.
* PHP 8.2
* [PostgreSQL 15](https://www.postgresql.org/)
* [Mailpit](https://github.com/axllent/mailpit) - http://localhost:8025/
* [Redis](https://redis.io/)


git clone
```
git@github.com:larabeeHQ/larabee.git
```

Install composer packages
```
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php82-composer:latest \
    composer install --ignore-platform-reqs
```
Running migrations and seeders.
```
sail artisan migrate:fresh --seed
```

i18n
```
php artisan vue-i18n:generate
```
