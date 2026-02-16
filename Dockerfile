# Pakai PHP + Apache, lebih stabil untuk Laravel production
FROM php:8.2-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    unzip \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install \
        pdo \
        pdo_mysql \
        mbstring \
        exif \
        pcntl \
        bcmath \
        gd \
        zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy project files
COPY . .

# Install Laravel dependencies
RUN composer install --no-interaction --optimize-autoloader --no-dev

# Set permissions storage & cache
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache

# Enable Apache rewrite module
RUN a2enmod rewrite

# Cache config, route, view (production ready)
RUN php artisan config:cache || true
RUN php artisan route:cache || true
RUN php artisan view:cache || true

# Expose default Apache port
EXPOSE 80

# Start Apache in foreground
CMD ["apache2-foreground"]
