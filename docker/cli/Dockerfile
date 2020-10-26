FROM php:7.4-alpine

LABEL maintainer="Ryan Durham <ryan@stagerightlabs.com>"

ARG NAME=www-data
ENV NAME ${NAME}
RUN deluser www-data && \
    adduser -s /bin/sh -D -u 1000 -g '' ${NAME} ${NAME} && \
    chown -R ${NAME}:${NAME} /home/${NAME}

# needed packages
RUN apk add --no-cache autoconf g++ libtool make supervisor \
    pcre-dev \
    libmcrypt-dev \
    postgresql-dev \
    zlib-dev \
    libzip-dev \
    freetype \
    freetype-dev \
    libpng \
    libpng-dev \
    libjpeg-turbo \
    libjpeg-turbo-dev \
    libjpeg \
    git

# install required php extensions
RUN docker-php-ext-configure gd \
    --enable-gd \
    --with-freetype \
    --with-jpeg

RUN docker-php-ext-install bcmath \
    gd \
    iconv \
    opcache \
    pdo pdo_pgsql pgsql \
    zip \
    exif

# configure php
COPY php.ini /usr/local/etc/php/conf.d/

# make sure that ~/.composer belongs to user
RUN mkdir /home/${NAME}/.composer && chown -R ${NAME}:${NAME} /home/${NAME}

# composer
COPY ./install-composer.php /home/${NAME}/
RUN php /home/${NAME}/install-composer.php --install-dir=/usr/local/bin --filename=composer && \
    rm /home/${NAME}/install-composer.php

# configure supervisor
COPY supervisord.conf /etc/supervisord.conf
RUN mkdir -p /var/log/supervisor/ && touch /var/log/supervisor/supervisord.log
RUN touch /var/run/supervisord.pid

# configure crontab
COPY crontab.tmp /home/${NAME}/crontab.tmp
RUN crontab /home/${NAME}/crontab.tmp && \
    rm /home/${NAME}/crontab.tmp

# clean
RUN apk del autoconf g++ libtool make pcre-dev
RUN rm -rf /tmp/* /var/cache/apk/*

# process - no USER is needed, since php will setuid
WORKDIR /var/www
ENTRYPOINT ["docker-php-entrypoint"]
