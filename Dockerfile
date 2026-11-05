# Use the official patched PHP 8.2 image with Apache web server
FROM php:8.2.35-apache

# Install the necessary PHP extensions for MySQL
RUN docker-php-ext-install pdo pdo_mysql mysqli

# Copy all application files to the server's root directory
COPY . /var/www/html/

# Make entrypoint script executable
RUN chmod +x /var/www/html/entrypoint.sh

# Expose port 80 
EXPOSE 80

# Launch server with background keep-alive daemon
ENTRYPOINT ["/var/www/html/entrypoint.sh"]
