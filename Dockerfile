FROM wordpress:latest

ARG WP_CLI=/usr/local/bin/wp
ARG WP_VERSION=6.8.1
ARG WP_ROOT=/var/www/html

# Установка WP-CLI
RUN curl -o $WP_CLI https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar \
    && chmod +x $WP_CLI

# Копируем wp-config.php, если есть
COPY wp-config.php $WP_ROOT

WORKDIR $WP_ROOT
