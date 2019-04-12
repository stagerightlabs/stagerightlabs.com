---
title: Laravel Passport and Travis CI
date: '2019-03-02 14:00'
layout: BlogPost
tags:
    - Laravel
    - Testing
---

When using Laravel Passport in a project that uses Travis for continuous integration, it is important to make sure that the testing  environment on travis is configured properly, otherwise you may encounter errors that will prevent your build from passing.

<!-- more -->

## The .travis.yml file

After some trial and error, I have come up with a working `.travis.yml` configuration.

~~~ @/snippets/laravel-passport-and-travis-ci/.travis.yml

The first two sections are self-explanatory.  We are going to be testing a PHP project, and we want Travis to test our code against PHP 7.1 and 7.2.

The `before_script` section is where we outline how we want the testing environment to be prepared before the tests are run.  Lets break this down line by line:

- `travis_retry composer self-update` <br />Here we are ensuring that we have the latest version of composer available to us in our testing container.
- `travis_retry composer install --prefer-source --no-interaction --no-suggest` <br /> Here we install the package dependencies outlined in the `composer.lock` file that lives in our project repo.
- `cp .env.travis .env` <br /> We will use a specially crafted `.env` file to ensure that the application being tested is configured correctly for this testing environment.  See below for more details.
- `php artisan key:generate` <br /> Here we will generate a hashing key that will be used for the lifetime of this test run.  The Laravel framework uses this value internally, so you should always generate a key even if you are not explicitly creating hashes in your application.
- `php artisan migrate` <br /> Here we are running the database migrations to create the DB structure that the application is expecting. I opted to publish the Passport migrations directly to my `database/migrations` folder, rather than registering them separately. Regardless, these migrations include the tables that Passport uses to store its client data.  It is also important to note that the project has been configured to use an in-memory sqlite database, which is why we don't have to create an empty database during these provisioning steps.
- `php artisan passport:keys` <br /> This is the most important step. Here we are asking Passport to generate the RSA keys that it uses to generate its grants.  By default these keys are stored in the `storage/` directory.

The `script` section is where we tell Travis how to run our tests.  Note that I am specifying that I want travis to use the version of PHPUnit that was installed via Composer, rather than the global version that it makes available to us in the container.  This way I can always know for sure exactly which version of PHPUnit I am running, and we can run a newer version if we want to.

The last section, `sudo: false`, is how we tell Travis to run our tests in a containerized environment.  This often means that our tests will run faster (though not always.). The downside is that we don't have `sudo` available to us when provisioning.  If we were to need that option we would have to use the slower, non-container environment that Travis offers.

## The .env configuration file

This is the special `.env.travis` file I used to specify application specific testing configuration:

~~~ @/snippets/laravel-passport-and-travis-ci/.env

The most important option here is the `DB_DATABASE=:memory:` option.  This tells the application that we want to use an in-memory sqlite database.  Even though the `APP_ENV` is "local" here, it will be over-written by the ENV values specified in the `phpunit.xml` file.  This is where we set the application environment to "testing" for the lifetime of the test run.

## The phpunit.xml file

We also set some importan environment variables in the `phpunit.xml` file:

~~~ @/snippets/laravel-passport-and-travis-ci/phpunit.xml

There are two important things to note about this file:

- We set the `APP_ENV` environment variable to "testing".  This puts our Laravel application into testing mode, which disables certain features like CSRF checks; which can be annoying to deal with when testing.
- Secondly, we are setting a random value as our `PASSPORT_CLIENT_SECRET` value.  This value matches the oauth secret used in our test fixtures when we create simulated Password Clients for our authentication tests.  The application I am testing uses an environment variable to store the ID of the password grant client we use to decode Json Web Tokens; we want to simulate that in our testing environment.  You may not need to do this if you are using Passport differently.

Thats it!  Once you understand how the pieces fit together it is not as complex as it first seems.
