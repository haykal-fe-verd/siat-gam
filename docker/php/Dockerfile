FROM php:8.1-fpm-alpine

RUN apk add --no-cache \
    bash git zip unzip curl \
    icu-dev oniguruma-dev libzip-dev \
    postgresql-dev \
    libpng-dev libjpeg-turbo-dev freetype-dev

RUN docker-php-ext-configure intl \
 && docker-php-ext-configure gd --with-jpeg --with-freetype \
 && docker-php-ext-install -j$(nproc) intl mbstring zip pdo_pgsql gd bcmath
#                                                     ↑↑↑ tambah ini

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
COPY docker/php/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

RUN addgroup -g 1000 laravel \
 && adduser -G laravel -g laravel -s /bin/sh -D -u 1000 laravel

WORKDIR /var/www/html
RUN chown -R laravel:laravel /var/www/html
USER laravel
