FROM wordpress:latest

ARG WP_CLI=/usr/local/bin/wp
ARG WP_VERSION=6.8.1
ARG WP_ROOT=/var/www/html

# Установка WP-CLI
RUN curl -o $WP_CLI https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar \
    && chmod +x $WP_CLI

# Установка Xdebug
RUN apt-get update && apt-get install -y --no-install-recommends \
    libzip-dev zip unzip libpng-dev libonig-dev libxml2-dev curl \
    && pecl install xdebug \
    && rm -rf /var/lib/apt/lists/*

# Настройки Xdebug
COPY ./xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

# Копируем wp-config.php, если есть
COPY wp-config.php $WP_ROOT

WORKDIR $WP_ROOT
