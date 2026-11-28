FROM node:20-alpine AS frontend

WORKDIR /app

COPY package*.json ./
RUN npm ci

COPY . .
RUN npm run build


FROM php:8.4-apache

WORKDIR /var/www/html

RUN apt-get update \
    && apt-get install -y \
        git \
        unzip \
        libsqlite3-dev \
        libzip-dev \
        libonig-dev \
    && docker-php-ext-install \
        pdo_sqlite \
        mbstring \
        bcmath \
        exif \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

COPY . .

COPY --from=frontend /app/public/build public/build

RUN composer install \
    --no-dev \
    --optimize-autoloader \
    --no-interaction

RUN a2enmod rewrite

COPY docker/apache.conf /etc/apache2/sites-available/000-default.conf

RUN php artisan storage:link || true

RUN chown -R www-data:www-data \
    storage \
    bootstrap/cache \
    database

EXPOSE 80

CMD ["apache2-foreground"]