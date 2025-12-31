FROM php:8.5-cli-alpine
RUN apk update \
    && apk add --no-cache gnupg linux-headers oniguruma-dev $PHPIZE_DEPS \
    && docker-php-ext-install mbstring pcntl \
    && docker-php-ext-enable mbstring pcntl \
    && wget -O /usr/local/bin/phive https://phar.io/releases/phive.phar \
    && chmod +x /usr/local/bin/phive \
    && apk del --purge $PHPIZE_DEPS

# Adding PIE :
COPY --from=ghcr.io/php/pie:bin /pie /usr/bin/pie

# Adding XDEBUG :
RUN apk add --no-cache php85-dev g++ make autoconf libtool bison re2c $PHPIZE_DEPS \
    && pie install xdebug/xdebug \
    && rm /usr/bin/pie \
    && apk del --purge $PHPIZE_DEPS \
    && echo "xdebug.mode=coverage" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

# Adding Composer :
COPY --from=composer /usr/bin/composer /usr/bin/composer

# Adding Phive :
RUN wget -O phive.phar https://phar.io/releases/phive.phar \
    && wget -O phive.phar.asc https://phar.io/releases/phive.phar.asc \
    && gpg --keyserver hkps://keys.openpgp.org --recv-keys 0x9D8A98B29B2D5D79 \
    && gpg --verify phive.phar.asc phive.phar \
    && chmod +x phive.phar \
    && mv phive.phar /usr/local/bin/phive

# Adding a user :
ARG uid
ARG user
RUN adduser -g "" -D -u "$uid" "$user"
