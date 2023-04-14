# wAnalytics Core

# Running Docker (Sail) Locally

The docker-compose contains all what you need to run wAnalytics on your localhost.
* PHP 8.2
* [PostgreSQL 15](https://www.postgresql.org/)
* [Mailpit](https://github.com/axllent/mailpit) - http://localhost:8025/
* [Redis](https://redis.io/)


git clone
```
git@github.com:WanalyticsHQ/wanalytics.git
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
