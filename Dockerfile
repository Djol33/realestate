# Use the official PHP image as the base image
FROM php:8.2.4-apache

# Set the working directory in the container
WORKDIR /var/www/html

# Copy the PHP files from your host to the container - index.php
COPY . .
RUN apt-get update && apt-get install -y default-mysql-client
RUN docker-php-ext-install pdo pdo_mysql
# Install MySQL and enable mysqli extension
RUN docker-php-ext-install mysqli
RUN docker-php-ext-enable mysqli


# Enable mod_rewrite and set log level to debug in Apache
RUN a2enmod rewrite \
    && echo "LogLevel debug" >> /etc/apache2/apache2.conf \
    && echo "ServerName localhost" >> /etc/apache2/apache2.conf
# Expose port 80 to access the Apache web server
EXPOSE 80

# Start the Apache web server and MySQL when the container starts     - service mysql start &&
CMD ["apache2-foreground"]

