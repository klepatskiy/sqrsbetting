FROM php:8.2-fpm

# add apt-get installs to this RUN
RUN apt-get update \
    && apt-get install -y \
        zip git libicu-dev libzip-dev libpq-dev libmemcached-dev nano mc pv htop curl  \
        libpng-dev libmagickwand-dev supervisor wget unzip librabbitmq-dev libssh-dev \
    && docker-php-ext-install \
        intl zip opcache pdo pdo_pgsql bcmath sockets gd soap sockets \
    && pecl install redis \
    && docker-php-ext-enable redis \
    && pecl install amqp \
    && docker-php-ext-enable amqp \
    && pecl install apcu \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*


RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY ./conf/php-fpm/dev/php.ini /usr/local/etc/php/php.ini
COPY ./conf/php-fpm/dev/remote-xdebug.ini /usr/local/etc/php/remote-xdebug.ini
COPY ./conf/php-fpm/www.conf /usr/local/etc/php-fpm.d/www.conf

### timezone ###
ARG TZ="Europe/Moscow"
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone
RUN echo "\ndate.timezone = $TZ" >> /usr/local/etc/php/php.ini

### permissions ###
RUN mkdir -p /var/www/var/cache /var/www/var/log && chmod -R 777 /var/www/var
WORKDIR /var/www/