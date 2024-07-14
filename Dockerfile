# docker buildx build --platform linux/amd64,linux/arm64 -t sever3d/academichain-ui --push .

# Use an official PHP runtime as a parent image
FROM php:8.0-apache

# Set the working directory in the container
WORKDIR /var/www/html

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    postgresql postgresql-contrib \
    libpq-dev \
    && docker-php-ext-install zip pdo_mysql \
    && pecl install redis \
    && docker-php-ext-enable redis \
    && docker-php-ext-install pdo_pgsql

## Change php.ini for Redis session
#RUN echo "session.save_handler redis" >> /usr/local/etc/php/conf.d/sessions.ini && \
#    echo "session.save_path tcp://redis:6379?auth=password" >> /usr/local/etc/php/conf.d/sessions.ini

# Copy your PHP application code into the container
COPY . .

# Expose the port Apache listens on
EXPOSE 80

# Start Apache when the container runs
CMD ["apache2-foreground"]