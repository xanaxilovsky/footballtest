ARG PHP_VERSION=7.4

FROM php:${PHP_VERSION}-fpm-alpine as php_fpm

COPY docker/php/config/php.ini /usr/local/etc/php/

RUN apk add icu-dev
RUN docker-php-ext-configure intl && docker-php-ext-install intl

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
ENV COMPOSER_ALLOW_SUPERUSER=1

COPY . /var/www/api

WORKDIR /var/www/api

RUN apk add yarn
RUN yarn install
RUN yarn ${APP_ENV}

CMD ["php-fpm"]
