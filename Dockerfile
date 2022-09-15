FROM php:8-apache as base
RUN docker-php-ext-install mysqli

FROM base as prod
WORKDIR /var/www/html/
COPY ./src .
