# 1PHPD-Project-temp

## Launch / stop the project

```console
docker compose up -d --build
docker compose down
```

## Access to website

```console
http://localhost
```

## Access to API

```console
http://localhost:8080
```

## Access to phpMyAdmin

```console
http://localhost:8081
```

## DB configuration

You can change these parameters in the docker-compose.yml
```console
MYSQL_DATABASE: db
MYSQL_USER: user
MYSQL_PASSWORD: password
```

## Adding modules

You can add modules in the config/Dockerfile (needs to re-build the project)
```console
docker-php-ext-install gd zip pdo_mysql ...
```
