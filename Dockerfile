FROM php:8.4-fpm

# Cài thư viện hệ thống cần thiết cho Laravel & GD
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl \
 && docker-php-ext-configure gd --with-freetype --with-jpeg \
 && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd

WORKDIR /var/www/html

# Copy source code
COPY . .

# Cài Composer
COPY --from=composer:2.7 /usr/bin/composer /usr/bin/composer

RUN composer install
