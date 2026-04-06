ARG PHP_VERSION=8.2

###
# Caddy image
###
FROM caddy:2-alpine AS web

COPY ./deploy/Caddyfile /etc/caddy/
COPY ./src/ /app/

VOLUME /app/
EXPOSE 80

###
# PHP app image
###
FROM chialab/php${PHP_IMAGE_VARIANT}:${PHP_VERSION}-fpm AS app

COPY deploy/php-conf.ini /usr/local/etc/php/conf.d/cake.ini
COPY deploy/phpfpm-conf.ini /usr/local/etc/php-fpm.d/zzz-cake.conf

# Setup user.
RUN mkdir -p /app && chown www-data:www-data /app
USER www-data
WORKDIR /app

# Copy application
COPY --chown=www-data:www-data ./src/ /app/
COPY --chown=www-data:www-data ./src/dbconnect.example.php /app/dbconnect.php
