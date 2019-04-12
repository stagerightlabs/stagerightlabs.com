---
title: 'Using Mockery with Codeception and Laravel 4'
date: '2015-11-30 16:00'
layout: BlogPost
tags:
    - Laravel
    - Testing
    - Codeception
---

I have a new client who came to me wanting to build out some new features on an existing Laravel 4.2 application. Unfortunately the codebase did not have any tests, wich complicates the process of implementing the new changes. As a sort of stop-gap measure, we have agreed to add some "retro-active" acceptance tests to make sure that the existing functionality isn't inadvertently broken.

<!-- more -->

Being on 4.2, it does not have access to all of the great testing conveniences found in Laravel 5.\*, which is unfortunate because it means I didn't have access to any of Laravel 5's convenient test helpers. Codeception is a great alternative testing package that provides a wealth of functionality and it is already compatible with Laravel 4 - this seemed like the best choice for us. So far, it has been working quite well for us, but I did run into one particularly frustrating problem: Binding mocks of service classes to the IoC does not work "out of the box". This is frustrating if you have a service class that hits a third-party API and you don't want to have to hit that API each time you run your tests.

As it turns out, this problem is due to the Laravel4 Module re-initializing the Application object on each request. While it looks like this should work, it actually doesn't:

~~~ @/snippets/using-mockery-with-codeception/codeception-example.php

When the `amOnRoute()` method is executed, the Application is refreshed and all of your custom bindings are lost in favor of the bindings you establish in your service provider(s). This is triggerd by the `doRequest()` method on the `Codeception\Lib\Connector\Laravel4` class, which is used by default in the Laravel4 module. The solution that worked for me was to extend the Laravel4 module and its connector class. This allowed me to remove the offfending line from the `doRequest()` method. Also, the Laravel4 module does not provide any methods for helping with temporary binding; creating a custom module allowed me to add some convenient methods to help with this.

Jordan Eldredge [has a great article about writing custom Codeception modules](https://jordaneldredge.com/blog/writing-a-custom-codeception-module/). Using the methods he describes in his post we can create a custom Codeception Module and a new Connector library which is identical to the existing Laravel4 connector library. Only one change is required to the existing connector library, on line 47:

~~~ @/snippets/using-mockery-with-codeception/laravel-connector.php

Now we can create a custom module that extends the Laravel4 module and add some new functionality:

~~~ @/snippets/using-mockery-with-codeception/laravel-handler.php

Presto! That is all there is to it. Now your mock objects can be bound appropriately and will remain in place for the duration of the test. Our new acceptance test looks like this:

~~~ @/snippets/using-mockery-with-codeception/laravel-example.php

I have added my custom module and connector to my [Laravel-Testing-Utilities](https://github.com/SRLabs/laravel-testing-utilities) package if you would like to make use of them in your own Laravel 4.2 application. Currently they are only on the 1.\* branch, but if needed I will add them to the other versions of that package down the road.
