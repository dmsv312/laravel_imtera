FROM php:8.2-apache

ARG USER_HOME=/var/www/html

# Install dependencies
RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        git \
        zip \
        unzip \
        libonig-dev \
        libxml2-dev \
        libzip-dev \
        libpng-dev \
        libjpeg-dev \
        libfreetype6-dev \
        libssl-dev \
        pkg-config \
        libicu-dev \
        libcurl4-openssl-dev \
    && docker-php-ext-configure gd --with-jpeg --with-freetype \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd intl zip \
    && a2enmod rewrite \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR ${USER_HOME}

COPY composer.json ./
RUN composer install --no-dev --no-scripts --prefer-dist --no-interaction

COPY . ./

RUN cp .env.example .env \
    && composer install --no-dev --optimize-autoloader --no-interaction \
    && php artisan key:generate --ansi --force \
    && chown -R www-data:www-data storage bootstrap/cache

EXPOSE 80

CMD ["apache2-foreground"]
