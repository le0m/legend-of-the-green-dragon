ARG PHP_VERSION=8.2

###
# App image
###
FROM chialab/php:${PHP_VERSION}-apache

RUN cp /usr/local/etc/php/php.ini-production /usr/local/etc/php/php.ini
COPY deploy/php-conf.ini /usr/local/etc/php/conf.d/lotgd.ini
COPY deploy/apache.conf /etc/apache2/conf-enabled/lotgd.conf
COPY deploy/virtualhost.conf /etc/apache2/sites-enabled/lotgd.conf

# Setup user.
RUN mkdir -p /app && chown www-data:www-data /app
USER www-data
WORKDIR /app

# Copy application
COPY --chown=www-data:www-data ./src/ /app/
COPY --chown=www-data:www-data ./src/dbconnect.example.php /app/dbconnect.php

CMD apache2-foreground
