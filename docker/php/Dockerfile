FROM php:8.3-alpine

LABEL maintainer="Ryan Durham <ryan@stagerightlabs.com>"

# Set up a www-data user with UID 1000 and GID 1000
ARG NAME=www-data
ENV NAME ${NAME}
RUN deluser www-data && \
    adduser -s /bin/sh -D -u 1000 -g '' ${NAME} ${NAME} && \
    chown -R ${NAME}:${NAME} /home/${NAME}

# needed packages
RUN apk add --no-cache --virtual build-deps autoconf g++ libtool make linux-headers && \
    apk add --no-cache git libzip-dev

# Install PHP Extensions
RUN docker-php-ext-install zip

# Increase the default memory limit
RUN echo 'memory_limit = 1096M' >> /usr/local/etc/php/conf.d/docker-php-memlimit.ini;

# Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Add Composer to the PATH
ENV PATH="$PATH:/usr/local/bin:/home/${NAME}/.composer/vendor/bin"

# Ensure ~/.composer belongs to user
RUN mkdir /home/${NAME}/.composer && chown -R ${NAME}:${NAME} /home/${NAME}

# Install XDebug extension for code coverage support
RUN pecl install xdebug && docker-php-ext-enable xdebug
COPY xdebug.ini /usr/local/etc/php/conf.d

# Clean up apk dependencies
RUN apk del build-deps

# Set the active user
USER ${NAME}

# Set the active directory
WORKDIR /var/www

# Serve the web application through the PHP dev server
CMD ["php", "artisan", "serve", "--host", "0.0.0.0"]
