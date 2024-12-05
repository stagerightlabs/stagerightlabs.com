#!/usr/bin/env bash

# Heavily borrowed from Cris Fidao and the "Shipping Docker" course
# https://serversforhackers.com/shipping-docker

COMPOSE="docker compose"

# If we pass any arguments...
if [ $# -gt 0 ];then

    # Run the artisan console
    if [ "$1" == "art" ]; then
        shift 1
        $COMPOSE exec \
            php \
            php artisan "$@"

    # Run the artisan console
    elif [ "$1" == "artisan" ]; then
        shift 1
        $COMPOSE exec \
            php \
            php artisan "$@"

    # Run Composer
    elif [ "$1" == "composer" ]; then
        shift 1
        $COMPOSE exec \
            php \
            composer "$@"

    # Run NPM
    elif [ "$1" == "yarn" ]; then
        shift 1
        $COMPOSE run --rm \
            node \
            yarn "$@"

    # Else, pass through to docker compose
    else
        $COMPOSE "$@"
    fi

else
    $COMPOSE ps
fi
