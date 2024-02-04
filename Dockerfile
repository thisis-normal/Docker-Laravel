FROM php:8.2.13 as php

RUN apt-get update -y
RUN apt-get install -y  unzip libzip-dev libcurl4-gnutls-dev libpq-dev
RUN docker-php-ext-install pdo pdo_mysql bcmath curl

RUN pecl install -o -f redis \
    && rm -rf /tmp/pear \
    && docker-php-ext-enable redis

# Set working directory to /var/www.
WORKDIR /var/www
# Copy files from current folder to container current folder (set in workdir).
COPY --chown=www-data:www-data . .
#COPY . .

COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

ENV PORT=8000
#COPY entrypoint.sh /entrypoint.sh
RUN chmod +x entrypoint.sh
# Run the entrypoint file.
ENTRYPOINT [ "entrypoint.sh" ]
