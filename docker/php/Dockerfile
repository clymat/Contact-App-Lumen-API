FROM php:7.3-fpm

# Install git
RUN apt-get update && apt-get install -y git

# zip requires zlib
RUN apt-get update && apt-get install -y zlib1g-dev libzip-dev

# Install php dependencies
RUN docker-php-ext-install pdo pdo_mysql
RUN docker-php-ext-install bcmath
RUN docker-php-ext-install zip

# Install gd
RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
    && docker-php-ext-install -j$(nproc) iconv \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd

#Install composer
RUN php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer

# Set directory
WORKDIR /var/www/platform
# RUN composer install