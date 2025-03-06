# Subscriber Management API built with Laravel

## Project Setup

```sh
 composer install
```

### Seed data

```sh
 php artisan migrate:refresh --seed
```

### Run tests

```sh
 php artisan test
```

### Start the API server

```sh
 php artisan serve
```

## API design specifications

### Functional requirements

Create a Subscriber Manager API for managing two resources and their relations: `subscribers`
and `fields`. 

**Subscriber** resource must have these properties:
* email address (in valid format and host domain must be active)
* name
* state (active, unsubscribed, junk, bounced, unconfirmed)

**Field** resource must have these properties:
* title (e.g. company, country, birthday)
* type (date, number, string, boolean)

>Fields are shared between subscribers.  
Each subscriber can have different field values.  
Each field value belongs to a single field.

### API schema documentation (routes)
Open http://127.0.0.1:8000/api

### Further considerations
This project is built using [API Platform for Laravel Projects](https://api-platform.com/docs/laravel/) for rapid development.
