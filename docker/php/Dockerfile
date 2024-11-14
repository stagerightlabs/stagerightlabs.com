FROM php:8.3-alpine

LABEL maintainer="Ryan Durham <ryan@stagerightlabs.com>"

ARG NAME=www-data
ENV NAME ${NAME}
RUN deluser www-data && \
    adduser -s /bin/sh -D -u 1000 -g '' ${NAME} ${NAME} && \
    chown -R ${NAME}:${NAME} /home/${NAME}

# needed packages
RUN apk add --no-cache git libzip-dev

# Install PHP Extensions
RUN docker-php-ext-install zip

# Add Composer to the PATH
ENV PATH="$PATH:/usr/local/bin:/home/${NAME}/.composer/vendor/bin"

# Ensure ~/.composer belongs to user
RUN mkdir /home/${NAME}/.composer && chown -R ${NAME}:${NAME} /home/${NAME}

# Set the active user
USER ${NAME}

# Set the active directory
WORKDIR /var/www

# Serve the web application through the PHP dev server
CMD ["php", "artisan", "serve", "--host", "0.0.0.0"]
