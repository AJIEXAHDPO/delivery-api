FROM php:8.2-fpm-alpine

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN set -ex \
    	&& apk --no-cache add postgresql-dev \
    	&& docker-php-ext-install pdo pdo_pgsql pgsql

WORKDIR /var/www/html