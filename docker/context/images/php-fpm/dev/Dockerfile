FROM ghcr.io/roadrunner-server/roadrunner:2024.2.1 AS roadrunner
FROM php:8.3-cli

ARG HOST_UID=1000
ARG HOST_GID=1000

COPY --from=roadrunner /usr/bin/rr /usr/local/bin/rr
COPY --from=composer:2.2 /usr/bin/composer /usr/local/bin/composer

RUN apt-get update
RUN apt-get -y install git

COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/bin/install-php-extensions
RUN install-php-extensions gd pgsql pdo_pgsql xdebug amqp apcu intl zip opcache pdo bcmath sockets redis
RUN install-php-extensions pdo_mysql pcntl posix json_post jsonpath openssl curl

WORKDIR /app

COPY . /app

RUN userdel -f www-data &&\
    if getent group www-data ; then groupdel www-data; fi &&\
    groupadd -g ${HOST_GID} www-data &&\
    useradd -l -u ${HOST_UID} -g www-data www-data &&\
    install -d -m 0755 -o www-data -g www-data /home/www-data &&\
    chown --changes --silent --no-dereference --recursive \
          --from=33:33 ${HOST_UID}:${HOST_GID} \
        /app

USER www-data

CMD rr serve -c .rr.yaml
