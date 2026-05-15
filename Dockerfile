FROM php:8.2-apache

ENV DEBIAN_FRONTEND=noninteractive

# System packages required for PHP extensions and image processing
RUN apt-get update && apt-get install -y --no-install-recommends \
	libpng-dev \
	libjpeg-dev \
	libfreetype6-dev \
	libonig-dev \
	libxml2-dev \
	libzip-dev \
	default-mysql-client \
	libicu-dev \
	zip \
	unzip \
	git \
	curl \
	&& rm -rf /var/lib/apt/lists/*

# Configure and install PHP extensions
RUN docker-php-ext-configure zip --with-libzip \
	&& docker-php-ext-configure gd --with-jpeg --with-freetype \
	&& docker-php-ext-install -j$(nproc) pdo_mysql mbstring exif pcntl bcmath gd zip intl opcache

# Enable Apache rewrite for Laravel pretty URLs
RUN a2enmod rewrite

# Use the Laravel public folder as DocumentRoot
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf \
	&& sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copy application code
COPY . /var/www/html

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist

# Set folder permissions for Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
	&& chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 80

CMD ["apache2-foreground"]
