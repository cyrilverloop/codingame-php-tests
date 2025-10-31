FROM php:8.4-cli-alpine
RUN apk update \
    && apk add gpg linux-headers oniguruma-dev $PHPIZE_DEPS \
    && docker-php-ext-install pcntl mbstring \
    && pecl install xdebug \
    && docker-php-ext-enable mbstring pcntl xdebug \
    && wget -O /usr/local/bin/phive https://phar.io/releases/phive.phar \
    && chmod +x /usr/local/bin/phive \
    && apk del --purge $PHPIZE_DEPS \
    && echo "xdebug.mode=coverage" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

COPY --from=composer /usr/bin/composer /usr/bin/composer

# Ajout de l'utilisateur :
ARG uid
ARG user
RUN adduser -g "" -D -u "$uid" "$user"
