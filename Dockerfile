# Stage 1: Build Stage
FROM php:8.3-cli AS build

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    libzip-dev curl unzip libpng-dev libonig-dev libxml2-dev \
    build-essential zlib1g-dev libcurl4-openssl-dev pkg-config \
    libicu-dev git \
    && docker-php-ext-configure intl \
    && docker-php-ext-install pdo_mysql zip bcmath intl \
    && pecl install redis \
    && docker-php-ext-enable redis

# Install Node.js and npm
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - && \
    apt-get install -y nodejs && \
    node -v && npm -v

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set working directory
WORKDIR /var/www/html

# Copy project files
COPY . .

# Install PHP dependencies
ARG APP_ENV=production

RUN git config --global --add safe.directory /var/www/html

RUN if [ "$APP_ENV" = "production" ]; then \
    composer install --optimize-autoloader --no-dev; \
  else \
    composer install; \
  fi

# Install Node.js dependencies and build assets
RUN if [ "$APP_ENV" = "production" ]; then \
    npm install && npm run build; \
  else \
    npm install; \
  fi

# Stage 2: Production Image
FROM php:8.3-apache

# Install required extensions (including intl)

RUN apt-get update && apt-get install -y \
    libzip-dev \
    libicu-dev \
    && docker-php-ext-configure intl \
    && docker-php-ext-install pdo_mysql zip intl \
    && pecl install redis \
    && docker-php-ext-enable redis \
    && apt-get clean && rm -rf /var/lib/apt/lists/*


# Install Composer in the production stage
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set the Laravel public directory as the document root
SHELL ["/bin/bash", "-c"]
RUN echo $'<VirtualHost *:80> \n\
    ServerAdmin webmaster@localhost \n\
    DocumentRoot /var/www/html/public \n\
    <Directory /var/www/html/public> \n\
        AllowOverride All \n\
        Require all granted \n\
    </Directory> \n\
</VirtualHost>' > /etc/apache2/sites-available/000-default.conf && a2enmod rewrite

# Copy only necessary files from build stage
COPY --from=build /var/www/html /var/www/html

# Set permissions
RUN chown -R www-data:www-data /var/www/html

# Use environment-specific php.ini
ARG APP_ENV=production
RUN if [ "$APP_ENV" = "production" ]; then \
    cp /usr/local/etc/php/php.ini-production /usr/local/etc/php/php.ini; \
  else \
    cp /usr/local/etc/php/php.ini-development /usr/local/etc/php/php.ini; \
  fi

# Expose the default web server port
EXPOSE 80

# Default command
CMD ["apache2-foreground"]
