# Use the official PHP image with Apache web server
FROM php:8.2-apache

# Copy all your HTML and PHP files to the server's root directory
COPY . /var/www/html/

# Expose port 80 (where Render expects web traffic)
EXPOSE 80
