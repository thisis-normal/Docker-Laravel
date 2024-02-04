#FROM php:8.2.13-fpm as php
## Set working directory to /var/www.
#WORKDIR /var/www
#
#RUN apt-get update \
#    && apt-get install --quiet --yes --no-install-recommends \
#        libzip-dev \
#        unzip \
#    && docker-php-ext-install zip pdo pdo_mysql \
#    && pecl install -o -f redis-7.2 \
#    && docker-php-ext-enable redis
#
#COPY --from=composer /usr/bin/composer /usr/bin/composer
#
#
#
#
#
