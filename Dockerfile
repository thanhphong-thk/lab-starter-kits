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
 && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd \
 && apt-get clean && rm -rf /var/lib/apt/lists/*

# Thư mục làm việc
WORKDIR /var/www/html

# Copy source code
COPY . .

# Copy composer
COPY --from=composer:2.7 /usr/bin/composer /usr/bin/composer

# Cài dependencies PHP (Laravel)
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Copy entrypoint script
COPY ./docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

# Dùng entrypoint custom
ENTRYPOINT ["entrypoint.sh"]

# Chạy php-fpm
CMD ["php-fpm"]
