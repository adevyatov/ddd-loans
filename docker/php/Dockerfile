FROM php:8.3-cli AS builder

RUN apt-get update && apt-get install -y \
    zip unzip git libzip-dev libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql bcmath ctype iconv

WORKDIR /app

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
COPY . .

RUN composer install --prefer-dist --no-interaction

RUN ls -la /app