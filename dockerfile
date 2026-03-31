FROM php:8.2-fpm

# Ставим необходимые системные зависимости
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    && docker-php-ext-install zip

WORKDIR /var/www/html