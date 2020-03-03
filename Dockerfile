FROM php:7.2-fpm-alpine

RUN docker-php-ext-install \
    pdo \
    pdo_mysql \
    mbstring

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /app
COPY . /app

RUN composer install

CMD php artisan serve --host=0.0.0.0 --port=8000
EXPOSE 8000