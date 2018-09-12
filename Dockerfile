FROM php:7.2

WORKDIR /app

RUN apt-get update && apt-get install -y libpng-dev git
RUN docker-php-ext-install pdo_mysql
RUN docker-php-ext-install gd
RUN curl -L "https://getcomposer.org/composer.phar" -o /usr/local/bin/composer && chmod +x /usr/local/bin/composer
RUN usermod -u 1000 www-data && groupmod -g 1000 www-data && chown -R 1000:1000 /app
