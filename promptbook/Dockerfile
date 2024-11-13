FROM php:8.2-fpm

# Set working directory
WORKDIR /app

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    curl \
    git \
    unzip \
    libzip-dev \
    libpq-dev \
    && docker-php-ext-install zip pdo_mysql \
    && rm -rf /var/lib/apt/lists/*

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy composer files
COPY composer.json composer.lock ./

# Run Composer install with flags
RUN composer install --no-scripts --no-autoloader --no-interaction

# Copy the rest of the application code
COPY . .

ENV PORT=8000

# Command to run the application
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]