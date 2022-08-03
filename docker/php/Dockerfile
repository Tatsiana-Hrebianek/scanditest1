FROM php:7.3-fpm-alpine

RUN apk update

COPY ./docker/php/config/php.ini $PHP_INI_DIR/php.ini

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY ./docker/php/config/xdebug-3.0.ini $PHP_INI_DIR/conf.d/xdebug.ini
RUN docker-php-source extract && \
    mkdir --parents /usr/src/php/ext/xdebug && \
    curl -fsSL https://github.com/xdebug/xdebug/archive/xdebug_3_0.tar.gz | tar xvz -C /usr/src/php/ext/xdebug --strip 1

RUN apk add bash bash-completion findutils grep busybox-extras

RUN docker-php-ext-install bcmath pdo_mysql xdebug

WORKDIR /var/www
