FROM php:7.3-cli-alpine
RUN apk update \
    && apk add gpg $PHPIZE_DEPS \
    && docker-php-ext-install pcntl mbstring \
    && pecl install xdebug \
    && docker-php-ext-enable mbstring pcntl xdebug \
    && wget -O /usr/local/bin/phive https://phar.io/releases/phive.phar \
    && chmod +x /usr/local/bin/phive \
    && apk del --purge $PHPIZE_DEPS \
    && echo "xdebug.mode=coverage" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

COPY --from=composer /usr/bin/composer /usr/bin/composer
# https://getcomposer.org/doc/03-cli.md#composer-allow-superuser
ENV COMPOSER_ALLOW_SUPERUSER=1
