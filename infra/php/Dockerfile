FROM php:8.1.4-fpm

WORKDIR /var/www/html

RUN apt-get update \
    && apt-get install -y git zip unzip libpq-dev exiftool zlib1g-dev libonig-dev libzip-dev libpng-dev libmagickwand-dev libcurl4-openssl-dev pkg-config libssl-dev \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

RUN pecl install xdebug \
    && pecl install imagick \
    && pecl install mongodb \
    && docker-php-ext-enable xdebug \
    && docker-php-ext-configure exif \
    && docker-php-ext-install exif \
    && docker-php-ext-enable exif \
    && docker-php-ext-install mbstring \
    && docker-php-ext-enable imagick \
    && docker-php-ext-install zip \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN echo "extension=mongodb.so" > /usr/local/etc/php/conf.d/ext-mongodb.ini

RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

COPY --chown=www:www . /var/www/html

USER www

CMD ["php-fpm"]
