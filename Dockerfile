# Allow PHP-FPM to read Render environment variables
RUN echo "clear_env = no" >> /usr/local/etc/php-fpm.d/www.conf

# Use the official PHP image with Apache web server
FROM php:8.2-apache

# Install the necessary PHP extensions for MySQL
RUN docker-php-ext-install pdo pdo_mysql mysqli

# Copy all your HTML and PHP files to the server's root directory
COPY . /var/www/html/

# Expose port 80 
EXPOSE 80
