---
title: "Laravel 5 Package Development: The Service Provider"
date: '2015-01-27 22:00'
layout: BlogPost
categories:
    - Laravel
---

Lets now look at upgrading our pacakge service provider to work with Laravel 5.   The service provider is intended to inform the application of the package's existance and register its assets. Exactly how this is done will vary depending on the needs of the pacakge, but there are several common items which we will discuss here: Configuration, Language Files, Views and Public Assets.   <!-- more -->John Hout has a [great write up](http://woodmarks.nl/laravel-5-loading-package-views-language-files/) about this, which I will be expanding on.

Two important things before we begin. First have to remove this line from our ```boot()``` method, because it is no longer needed:

```php
$this->package('rydurham/sentinel');
```
Secondly, Laravel 5 now ships with a ```vendor:publish``` command, which greatly simplifies copying files from the vendor/package directory into the main application.  Any folders or files added to the ```$this->publishes``` array in the ```boot()``` method will be published when you run the ```vendor:publish``` command.  (Vendor in this case is literally 'vendor', not the vendor name of your package.) As per the documentation, add this to your ```boot()``` command:

```php
public function boot()
{
    // ...

    $this->publishes([
        __DIR__.'/path/to/file1.php' => base_path('location/in/main/application/file1.php'),
        __DIR__.'/path/to/directory' => base_path('location/in/main/application/directory'),
        // Add as items as you want, pointing to any location.
        // Works with both files and directories
    ]);

    // ...
}
```

## Configuration
Configuration management in Laravel 5 has been greatly simplified, and there is no longer a need for accessing config options via a namespace. Add your package config file to the ```$this->publishes``` array and publish it to the main application config folder: ```base_path('config/sentinel.php')```.  You can name it whatever you want, but I would reccomend giving it the same name as your package.

Accessing config values can be done in the same way you are used to: ```Config::get('sentinel.allow_usernames')``` or you can use a new helper function ```config('sentinel.allow_usernames')```

It is possible that someone using your package may not publish the config file, or they only have a subset of the configurable values in their local version of the config file.  In those situations it can be beneficial to selectively merge their config file with the default config file in the pacakge repository.  This can be done with the ```mergeConfigFrom``` method in the ```boot``` function:

```php
public function boot()
{
    // ...

    $this->mergeConfigFrom(__DIR__.'/../config/sentinel.php', 'sentinel');

    // ...
}
```

## Views and Assets
Package views can still be accessed via a namespace.  In lieu of the old ```view:publish``` command, you should add your views to the ```publishes``` array.  The ```loadViewsFrom``` function allows you to register the view namespace, however you may want to check to see if the views have been published before you create the namespace:

```php
public function boot()
{
    // ...

    // Establish Views Namespace
    if (is_dir(base_path() . '/resources/views/packages/rydurham/sentinel')) {
        // The package views have been published - use those views.
        $this->loadViewsFrom(base_path() . '/resources/views/packages/rydurham/sentinel', 'Sentinel');
    } else {
        // The package views have not been published. Use the defaults.
        $this->loadViewsFrom(__DIR___ . '/../views/bootstrap', 'sentinel');
    }

    // ...
}
```
Assets like javascript or images should be added to the ```publishes``` array and pointed to the public folder.

## Language Files

Making translation files available to the application is very straightforward, and translation strings can still be accessed with the ```trans()``` function using a namespace:

```php
public function boot()
{
    // ...

    // Establish Translator Namespace
    $this->loadTranslationsFrom(__DIR__ . '/../lang', 'Sentinel');

    // ...
}
```

## Controllers & Routes
Some packages might make use of their own controllers and routing.  To add routes, just include the routes.php file as such:

```php
public function boot()
{
    // ...

    // Add Sentinel Routes
    include __DIR__ . '/../routes.php';

    // ...
}
```

Controllers should be namespaced, and autoloaded via the composer.json file:

```json
// composer.json
"autoload": {
    "classmap": [
        "src/seeds",
        "src/controllers"
    ],
    "psr-4": {
        "Sentinel\\": "src/Sentinel"
    }
},
```

## Resources
- [Package Development documentation](http://laravel.com/docs/master/packages)
- [Laravel 5 - loading package views / language files](http://woodmarks.nl/laravel-5-loading-package-views-language-files/)
