# Use the official PHP image as a base image
FROM php:8.1-fpm

# Set working directory
WORKDIR /var/www

# Install system dependencies including those needed for common extensions
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libwebp-dev \
    zlib1g-dev \
    libxml2-dev \
    libicu-dev \
    libzip-dev \
    libssl-dev \
    libcurl4-openssl-dev \
    locales \
    zip \
    git \
    curl \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy application files
COPY . /var/www

# Set permissions
RUN chown -R www-data:www-data /var/www \
    && chmod -R 755 /var/www

# Expose port 9000
EXPOSE 9000

CMD ["php-fpm"]
