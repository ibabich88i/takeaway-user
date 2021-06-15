# Test task

## Requirements
* PHP 7.4
    - This version has a lot of useful features such as typed properties, arrow functions, null coalescing assignment operator etc. In case of need we can increase performance by turning on OPcache.
* Mysql 5.7.29
    - Probably the most popular version of Mysql.
* Laravel 8.0 framework
    - The Latest version of framework with all with the newest features. A little overhead for each small project but although easy to deploy and use.

## Installation

##### Clone project
> git clone https://github.com/ibabich88i/takeaway-user.git

##### Copy .env file from .env.example

> `cp .env.example .env`

##### Deploy environment
> `docker-compose build`

> `docker-compose up -d`

##### Installing composer dependencies
> `docker-compose exec php composer install`

##### Run migrations
> `docker-compose exec php artisan migrate`

## Endpoints
### Users
#### User create
**POST** method
> `api/users  `

Example of body:
```json
{
    "name" : "user name",
    "email" : "test@test.test",
    "password" : "secret123456"
}
```

### PasswordReset
#### Take reset password token
**POST** method
> `api/forgot  `

Example of body:
```json
{
    "email" : "test@test.test"
}
```
#### Change User password
**PUT** method
> `api/reset  `

Example of body:
```json
{
    "token" : "dwad1ne24njernjrnj2nrj2rj2rnjr1",
    "password" : "secret123456",
    "passwordConfirmation" : "secret123456"
}
```
