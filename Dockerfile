# Use the official PHP image with Composer pre-installed
FROM php:8.2-cli

# Set the working directory inside the container
WORKDIR /app

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    && docker-php-ext-install pdo_mysql

# Install Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# Copy the project files into the container
COPY . /app

# Install project dependencies
RUN composer install --no-dev --optimize-autoloader

# Run PHPUnit tests by default
CMD ["vendor/bin/phpunit", "--bootstrap", "vendor/autoload.php", "tests --textdox"]