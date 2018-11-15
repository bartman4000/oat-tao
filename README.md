
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


## Usage

To change source of data use config file ***config/service.yaml***
Simply change binding for any of controllers from
```
$userService: '@json_user_client'
```
to
```
$userService: '@csv_user_client'
```
and vice versa
