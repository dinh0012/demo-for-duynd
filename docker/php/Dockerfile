FROM composer:1.5.1 AS composer
FROM php:7.4-fpm-alpine
COPY ./php.ini $PHP_INI_DIR/conf.d/

COPY --from=composer /usr/bin/composer /usr/bin/composer
ENV COMPOSER_ALLOW_SUPERUSER 1

RUN apk add --no-cache $PHPIZE_DEPS \
    && docker-php-ext-install pdo_mysql

