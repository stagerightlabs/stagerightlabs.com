#!/usr/bin/env bash

# Heavily borrowed from Cris Fidao and the "Shipping Docker" course
# https://serversforhackers.com/shipping-docker

# Set environment variables for local development
export APP_PORT=${APP_PORT:-80}

COMPOSE="docker-compose"

# If we pass any arguments...
if [ $# -gt 0 ];then

    # If "art" is used, pass-thru to "artisan"
    # inside a new container
    if [ "$1" == "art" ]; then
        shift 1
        $COMPOSE exec \
            cli \
            php artisan "$@"

    # If "composer" is used, pass-thru to "composer"
    # inside a new container
    elif [ "$1" == "composer" ]; then
        shift 1
        $COMPOSE exec \
            cli \
            composer "$@"

    # If "test" is used, run unit tests,
    # pass-thru any extra arguments to php-unit
    elif [ "$1" == "test" ]; then
        shift 1
        $COMPOSE exec \
            cli \
            ./vendor/bin/phpunit "$@"

    # If "npm" is used, run npm
    # from our node container
    elif [ "$1" == "npm" ]; then
        shift 1
        $COMPOSE run --rm \
            node \
            npm "$@"

    # Else, pass-thru args to docker-compose
    else
        $COMPOSE "$@"
    fi

else
    $COMPOSE ps
fi
