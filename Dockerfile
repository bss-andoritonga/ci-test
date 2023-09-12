# Use the official PHP image as the base image
FROM php:7.4-fpm

# Install necessary extensions and dependencies
RUN apt-get update && \
    apt-get install -y \
    libzip-dev \
    && docker-php-ext-install zip
RUN composer install
# Set the working directory
WORKDIR /var/www/html

# Copy your CodeIgniter application files to the container
COPY . .

# Install Composer dependencies (if you use Composer for CodeIgniter)
# RUN composer install --no-dev --optimize-autoloader

# Expose the port that your web server (e.g., Nginx or Apache) will use
EXPOSE 8080

# Start your web server (e.g., Apache or run PHP's built-in server)
CMD ["php", "-S", "0.0.0.0:8080", "-t", "public"]
