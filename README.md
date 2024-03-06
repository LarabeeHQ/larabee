# Larabee

A simple, lightweight, and open source Google Analytics alternative based on Laravel.

![Screenshot 2024-03-05 at 3 27 28 PM](https://github.com/LarabeeHQ/larabee/assets/265964/4190250c-0326-42db-8cfa-2c2ed0d275c1)


## Tracker
Larabee track your website with cookie-free, compliant with GDPR, and privacy-focused. But you can also identify users with a email, for example:

```html
<button
    data-larabee-event="Choose Plan"
    data-larabee-event-plan="Pro"
    data-larabee-event-user-id="1"
    data-larabee-event-user-email="hello@gmail.com"
    >
    Choose Pro Plan
</button>
```
data-larabee-event it's the event name, required. The other data-larabee-event-* are custom properties that you can use to filter and segment your data.

Example of a custom event in the dashboard:

![Screenshot 2024-03-06 at 3 17 39 PM](https://github.com/LarabeeHQ/larabee/assets/265964/b97f4532-5387-4088-937e-d1b59b10043e)

## Cloud Version
We have a cloud version where you can sign up and test at [app.larabee.io](https://app.larabee.io/register)

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
