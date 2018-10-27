# OAT Technical Exercise

## Note

I kind of mocked MysqlUserService to show how should be built UserService for other data source - mysql db in this case.

## Build

```
composer install
```

## Test

```
./vendor/bin/phpunit
```

## Run

1. create vhost pointing to ***/public*** directory as DocumentRoot

OR

2. Move into your new project and start the server:
```
php bin/console server:run
``` 

As it is Symfony based project you will find more details here: https://symfony.com/doc/current/setup.html

