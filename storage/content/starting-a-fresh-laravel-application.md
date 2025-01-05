---
title: Starting a Fresh Laravel Application
date: 2025-01-05
summary: Starting a new project is always an envigorating prospect; so much potential and possiblity, the very world is at your fingertips. It always feels good to start something new. When working on a web projects I prefer to use Laravel, and this article describes how I prepare a brand new project repository.
tags: Laravel, PHP, Docker
---

Starting a new project is always an envigorating prospect; so much potential and possiblity, the very world is at your fingertips. It always feels good to start something new. When working on a web projects I prefer to use Laravel, and this article describes how I prepare a brand new project repository.

I have created a dedicated [git repo](https://github.com/stagerightlabs/fresh-laravel-project) where all of the examples in this article can be referenced. Feel free to clone that repo to start your own project if you don't want to go through all these steps on your own.

## Create the new project

Step 1: Use composer to pull down a fresh copy of the Laravel framework. I prefer to use a [utility container](https://stagerightlabs.com/blog/utility-containers-for-php) for this as the docker images for the project don't yet exist.

```sh
php8.4 composer create-project laravel/laravel starter
cd starter
```

In this case 'starter' is the name of the folder where the code will be placed.

The stack we will be using includes:

- [PHP 8.4](https://www.php.net/)
- [Laravel 11](https://laravel.com/)
- [Tailwind 3.4](https://tailwindcss.com/)
- [Node 22](https://nodejs.org/)
- [PostgreSQL 17](https://www.postgresql.org/)

## Set up the development environment with Docker

[Laravel Sail](https://laravel.com/docs/11.x/sail) is an excellent tool for managing development environments with Docker, and it is one of the reccomended ways of getting up and running with a new Laravel application. However, I prefer to manage my Docker environment directly using Docker Compose.

We will start with three different services; one each for PHP, PostgreSQL and Node.

### PHP

The full Dockerfile can be [seen here](https://github.com/stagerightlabs/fresh-laravel-project/blob/2025/docker/php/Dockerfile). The base image is `php8.4-alpine`; most of the work done in the Dockerfile relates to user permissions and APK dependencies. There are a view items to note however:

The default PHP memory limit is increased to 1096M:

```dockerfile
# Increase the default memory limit
RUN echo 'memory_limit = 1096M' >> /usr/local/etc/php/conf.d/docker-php-memlimit.ini;
```

Composer is installed for PHP package management:

```dockerfile
# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Add Composer to the PATH
ENV PATH="$PATH:/usr/local/bin:/home/${NAME}/.composer/vendor/bin"

# Ensure ~/.composer belongs to user
RUN mkdir /home/${NAME}/.composer && chown -R ${NAME}:${NAME} /home/${NAME}
```

Xdebug is installed for step-debugging and code coverage reporting. There is a separate [xdebug.ini](https://github.com/stagerightlabs/fresh-laravel-project/blob/2025/docker/php/xdebug.ini) file in the repo containing the xdebug configuration.

```dockerfile
# Install XDebug extension for code coverage support
RUN pecl install xdebug && docker-php-ext-enable xdebug
COPY xdebug.ini /usr/local/etc/php/conf.d
```

Finally, the container is configured to run `php artisan serve` automatically when it spins up:

```dockerfile
# Serve the web application through the PHP dev server
CMD ["php", "artisan", "serve", "--host", "0.0.0.0"]
```

### PostgreSQL

The full PostgreSQL docker image can be [seen here](https://github.com/stagerightlabs/fresh-laravel-project/blob/2025/docker/postgres/Dockerfile). Here are a few things to note:

A [psqlrc](https://github.com/stagerightlabs/fresh-laravel-project/blob/2025/docker/postgres/.psqlrc) file has been included to configure the PostgreSQL command line tool:

```dockerfile
# Copy over the .psqlrc configuration file
COPY --chown=postgres:postgres .psqlrc /var/lib/postgresql/
```

An init.sql file has been included to scaffold the new databases:

```dockerfile
# Copy our init.sql into the container
# This will only be run if the persistence volume is empty
COPY --chown=postgres:postgres init.sql /docker-entrypoint-initdb.d/
```

When the PostgreSQL container spins up it checks to see if there are any known databases present. If not, all of the scripts in the `docker-entrypoint-initdb.d` folder will be run. In our case, the `init.sql` file sets up two new databases:

```sql
CREATE USER developer;
ALTER USER developer WITH PASSWORD 'secret';

CREATE DATABASE app_dev OWNER developer;
GRANT ALL PRIVILEGES ON DATABASE app_dev TO developer;

CREATE DATABASE app_test OWNER developer;
GRANT ALL PRIVILEGES ON DATABASE app_test TO developer;
```

### Node

The [node image](https://github.com/stagerightlabs/fresh-laravel-project/blob/2025/docker/node/Dockerfile) is very simple. The only modificatioin we make is configuring the image to run `yarn dev` automatically on startup:

```dockerfile
CMD [ "yarn", "dev" ]
```

### Building the Environment

The `docker-compose.yml` file is relatively straight forward:

```yml
services:
    php:
        build:
            context: docker/php
        volumes:
            - ./:/var/www/:cached
        ports:
            - 80:8000

    postgres:
        build:
            context: docker/postgres
        ports:
            - "54320:5432"
        environment:
            - EDITOR=vim
            - POSTGRES_PASSWORD=secret
        volumes:
            - pg-data:/var/lib/postgresql/data
            - ./docker/postgres/share:/var/lib/postgresql/share

    node:
        build:
            context: docker/node
        volumes:
            - ./:/var/www:cached
        ports:
            - 5173:5173

    mailpit:
        image: "axllent/mailpit:latest"
        ports:
            - "${FORWARD_MAILPIT_PORT:-1025}:1025"
            - "${FORWARD_MAILPIT_DASHBOARD_PORT:-8025}:8025"

volumes:
    pg-data:
```

I have included a [MailPit](https://mailpit.axllent.org/) service as well for testing email locally. With this docker-compose file in place, you can now build the images:

```
docker compose build
```

To be able to access the site from your browser you may want to add an entry to your local hosts file:

```
127.0.0.1   starter.test
```

You can spin the containers up now using `docker compose up -d`, but we don't quite have all of our dependencies in place yet.

## Using Vite for asset management

We can now install our node dependencies using the node image. I prefer to use Yarn for package management, but NPM works just as well here.

```sh
docker-compose run --rm node yarn
```

There is one small change we need to make to the [Vite config](https://github.com/stagerightlabs/fresh-laravel-project/blob/2025/vite.config.js) to get it working in our new docker environment. We will add a "server" block telling vite to use "0.0.0.0" as its default host:

```js
server: {
    host: "0.0.0.0",
    hmr: {
        host: "localhost",
    },
},
```

With this change in place we can now restart our containers and then view the new site in a web browser: http://starter.test. Laravel ships with Tailwind CSS by default, which also happens to be my preferred CSS tool. The default [tailwind.config.js](https://github.com/stagerightlabs/fresh-laravel-project/blob/2025/tailwind.config.js) file should be a sufficient starting place.

## Local Database

We need to tell our new application to use Postgres instead of Sqlite by default. This can be done in our [environment file](https://github.com/stagerightlabs/fresh-laravel-project/blob/2025/.env.example):

```env
DB_CONNECTION=pgsql
DB_HOST=postgres
DB_PORT=5432
DB_DATABASE=app_dev
DB_USERNAME=developer
DB_PASSWORD=secret
```

The 'host' value here is the name of the postgres docker service; this is shorthand used by the docker network for service resolution.

Our application database was created automatically when the container spun up for the first time. We can now run our migrations:

```sh
docker compose exec php php artisan migrate:fresh
```

A separate database was also created for the testing environment. We will need to update our [phpunit.xml](https://github.com/stagerightlabs/fresh-laravel-project/blob/2025/phpunit.xml) file with those details:

```xml
<php>
    <!-- other stuff -->
    <env name="DB_CONNECTION" value="pgsql"/>
    <env name="DB_HOST" value="postgres"/>
    <env name="DB_DATABASE" value="app_dev"/>
    <env name="DB_USERNAME" value="developer"/>
    <env name="DB_SECRET" value="secret"/>
    <!-- other stuff -->
</php>
```

## Tests and Code Coverage

With the xdebug extension installed we can configure PHPUnit to generate code coverage reports for us. We do this by adding a `<coverage>` block to the [phpunit.xml](https://github.com/stagerightlabs/fresh-laravel-project/blob/2025/phpunit.xml) file:

```xml
<coverage>
    <report>
        <html outputDirectory=".coverage" lowUpperBound="50" highLowerBound="90"/>
    </report>
</coverage>
```

The output directory can be whatever you would like; just make sure to add it to your git ignore file.

Composer offers the ability to run scripts for us, similar to NPM and Yarn. I prefer to use this method for running the test suite. To do this we will add a new entry in the `scripts` section of the [composer.json](https://github.com/stagerightlabs/fresh-laravel-project/blob/2025/composer.json) file:

```js
"scripts": {
    // ...
    "test": "vendor/bin/phpunit"
},
```

## Static Analysis

[PHPStan](https://phpstan.org/) is my preferred static analysis tool; and the [Larastan](https://github.com/larastan/larastan) project provides an excellent way to integrate static analysis into a Laravel application.

We will first add Larastan as a composer dependency:

```sh
docker compose exec php composer require --dev "larastan/larastan:^3.0"
```

Adding a [phpstan.neon](https://github.com/stagerightlabs/fresh-laravel-project/blob/2025/phpstan.neon) file to the root of the project allows us to configure PHPStan for this application. I personally strive for level 8 in all of my projects.

We can again use a composer script for running static analysis:

```js
"scripts": {
    // ...
    "phpstan": "phpstan analyze"
},
```

## Code Formatting

Laravel ships with a tool called [Pint](https://laravel.com/docs/11.x/pint) that performs PHP code formatting. Pint is a wrapper for the excellent `friendsofphp/php-cs-fixer` tool. We will set it up for this project using the "per" standard, which is the latest successor to the "psr-12" standard. We will also use composer to run our formatting for us:

```js
"scripts": {
    // ...
     "format": "pint --preset per",
},
```

I like to use Prettier for formatting JavaScript and Blade files. It can also automatically sort tailwind classes for us which is a nice bonus. Matt Stauffer has an [excellent post](https://mattstauffer.com/blog/how-to-set-up-prettier-on-a-laravel-app-to-lint-tailwind-class-order-and-more/) on his blog that details setting up Prettier for Laravel. The VSCode Prettier plugin will automatically run this formatting for us. We don't necessarily need to add a script to run it manually but we could by updating the "scripts" block in the [package.json](https://github.com/stagerightlabs/fresh-laravel-project/blob/2025/package.json) file:

```js
"scripts": {
    // ...
    "format": "prettier . --write"
},
```

## Ops Helper Script

To streamline local development tasks I like to set up an [ops helper script](https://github.com/stagerightlabs/fresh-laravel-project/blob/2025/ops.sh). This is an idea that I borrowed from Chris Fidao and his [Shipping Docker](https://serversforhackers.com/shipping-docker) course. It becomes super helpful when combined with a bash alias:

```sh
starter() {
    cd /full/path/to/project
    ./ops.sh ${*:-ps}
    cd $OLDPWD
}
```

You can call the function whatever you would like. With this alias in place you can now easily run development tasks without having to spell out the full docker command each time:

```sh
starter artisan make:model Team -mfs # Make a new model with a migration, factory and seeder
starter composer require [package] # Add a PHP package with Composer
starter composer format # Run Laravel Pint to format PHP code
starter composer phpstan # Run PHPStan for static analysis
starter composer test # Run the test suite
starter psql app_dev # Drop into the postgres cli for the app_dev database
starter yarn add [package] # Add a node dependency with Yarn
starter yarn format # Run a yarn script
```

This script is easily extendible if you add more services to the docker environment.
