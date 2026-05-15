# Tumia image rasmi ya PHP yenye Apache
FROM php:8.2-apache

# Sakinisha vikorokoro vya lazima
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
    curl

# Safisha cache ya apt ili kupunguza ukubwa wa image
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Sanidi na sakinisha PHP extensions (Njia ya kisasa)
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) pdo_mysql mbstring exif pcntl bcmath gd zip

# Washa Apache mod_rewrite
RUN a2enmod rewrite

# Weka DocumentRoot iwe kwenye /public ya Laravel
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Nakili kodi za project
COPY . /var/www/html

# Weka ruhusa (permissions)
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Sakinisha Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

EXPOSE 80

CMD ["apache2-foreground"]