---
title: Utility Containers for PHP
date: 2024-12-28
summary: Leverage bash functions and docker containers to allow quick access to tools like PHP and Node without installing them locally.
tags: PHP, Docker
---

I have found that after using Docker for a while the idea of installing programming libraries directly on my development machine undesirable; my preference is to use Docker for everything I can and keep the host machine as clean as possible. However, there are still times when having quick access to node or to PHP can be handy, and when those tools are not installed I feel friction in my productivity flow.

I have found that I can still use Docker for these situations by leveraging bash functions to make access to those containers smoother. This combination has become a productivity booster for me; it turns out to be very convenient.

As an added bonus, this technique let's me easily access different versions of PHP and Node on the same machine without bothering with NVM or switching between multiple PHP installs.

## Docker Container

First you will need an image containing the tool you want to run. If you are feeling adventurous you could build this yourself, or you could use one of the many images availably publicly on [hub.docker.com](hub.docker.com). For PHP I reccomend finding an image that has Composer already installed, as well as some of the more commonly used extensions such as BCMath and Zip. The [Kirschbaum Development Group](https://kirschbaumdevelopment.com/) maintains a [PHP image](https://hub.docker.com/r/kirschbaumdevelopment/laravel-test-runner) for use in continuous integration tools; this could be an ideal jumping off point for you.

One of the great benefits of Docker is its flexibilty. I started out with the Kirschbaum image but eventually needed to make my own modifications. I have published [my own verison](https://hub.docker.com/r/stagerightlabs/php-test-runner) of a "test runner" image. These image variants are customized for my particular needs; you can extend existing images or build your own as needed.

## Bash Function

Now that you have identified the container you want to use, add this function to your bash config:

```bash
php8.3() {
    docker run -it --rm \
    -u 1000 \
    -e COMPOSER_HOME=/home/www-data/.config/composer \
    -v $(pwd):/var/www \
    -w /var/www \
    -p 8000:8000 \
    stagerightlabs/php-test-runner:8.3 /bin/sh -c "${*:-sh}"
}
```

You can name the function whatever you would like. Let's run down the parameters:

1. `docker run -it --rm`: This tells docker that you want to run a container with an interactive shell and then automatically shut it down when the command is finsished.
2. `-u 1000`: This sets the user id for the container session. If your host machine is running linux this will allow you to avoid problems with permissions on files created in the image.  The number should match your user id on the host machine. On Ubuntu the default user is UID 1000.
3. `-e COMPOSER_HOME=/home/www-data/.config/composer`: This sets an environment variable in the container that tells Composer to use a custom home folder; in this case the UID user, aka "www-data" in this image. This ensures that all of Composer's cache files will be owned by the UID 1000 user to avoid more file permissions issues.
4. `-v $(pwd):/var/www`: This mounts the current working director on the host machine as a volume in Docker at the `/var/www` location.
5. `-w /var/www`: This sets `/var/www` as the current working directory for the container.
6. `-p 8000:8000`: This maps port 8000 in the container to port 8000 on the host machine. This is not strictly necessary, but you might find port mapping like this convenient, depending on your needs.
7. `stagerightlabs/php-test-runner:8.3`: This is the name of the container we are going to spin up.
8. `/bin/sh -c "${*:-sh}"`: This tells the container to execute a shell command. It will pass in any command line arguments you provide, or if none are provided it will drop you into a shell session.

## Usage

With this function in place you can now run PHP commands anywhere on your machine without installing PHP natively:

```sh
~/code/project $ php8.3 composer create-project laravel/laravel .
```

I find it particularly helpful when I am working on package development and I want to run tests or other composer commands:

```sh
~/code/package $ php8.3 vendor/bin/phpunit
~/code/package $ php8.3 composer require laravel/tinker
~/code/package $ php8.3 composer [some custom script]
```

This way I don't need to set up a dedicated image for the package and I can save on some of that overhead.

You can also execute PHP commands directly:

```sh
~ $ php8.3 php path/to/script.php
Output of the script...
~ $ php8.3 php -version
PHP 8.3.3 (cli) (built: Feb 16 2024 21:25:21) (NTS)
Copyright (c) The PHP Group
Zend Engine v4.3.3, Copyright (c) Zend Technologies
    with Xdebug v3.3.1, Copyright (c) 2002-2023, by Derick Rethans
```

## Node

This idea works with many different tools. I find it to be a very handy way to use Node and NPM:

```sh
node20() {
    docker run -it --rm -u 1000 -v $(pwd):/src node:20-alpine /bin/sh -c "cd /src; ${*:-sh}"
}
```

It may take a bit of work to dial in the configuration for the image you are using, but the payoff will be worth it.
