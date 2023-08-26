FROM phpdockerio/php:8.2-fpm

WORKDIR "/app"

RUN apt-get update \
    && apt-get -y --no-install-recommends install \
        php8.2-memcached \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php --install-dir=/usr/local/bin --filename=composer \
    && php -r "unlink('composer-setup.php');" \
RUN composer install

