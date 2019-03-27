---
title: Translating Custom Error Messages in Laravel Packages
slug: translating-custom-error-messages-laravel
date: '2014-10-04 19:00'
layout: BlogPost
tags:
    - Laravel
highlight:
    theme: tomorrow
---

Let's say that you are writing a Laravel package that involves data validation with custom error messages. Let's also say that you are interested in allowing your package to be translated into other languages. How would you pass your custom error strings to your validator?

<!-- more -->

I ran into this issue when working on my Laravel/Sentry 2 bridge package [Sentinel](http://www.ryandurham.com/projects/sentinel/). (It is not related to Cartalyst's Sentinel Package.) This package uses a Validation system inspired by the book [_Implementing Laravel_](https://leanpub.com/implementinglaravel) by Chris Fidao, and in several locations makes use of [custom error messages](http://laravel.com/docs/4.2/validation#custom-error-messages).

When I switched to using language strings instead of strait text I wasn't quite sure how to pull the custom error messages from the language files and pass them to the Validator. Here is what I landed on:

First we need to make sure that the Package's namespace is passed to the Translator. Add this line to the Service Provider's boot function:

```php
// Package Service Provider

class SentinelServiceProvider extends ServiceProvider {

   // ...

   public function boot()
   {
        // ...

        // Add the Translator Namespace
        $this->app['translator']->addNamespace('Sentinel', __DIR__.'/../lang');
   }

}
```

The `addNamespace` function informs Laravel's translator class of the location of our language files and allows for the use of the 'Sentinel' namespace when translating language strings. We can now reference the Sentinel Package language strings via the `Illuminate\Translation\Translator` class:

```php
 echo Lang::get('Sentinel::users.noaccess')

 // Result:
 // You are not allowed to do that.
```

We can also use `trans()`, which is a helper function that aliases `Lang::get()`.

```php
 echo trans('Sentinel::users.noaccess')

 // Result:
 // You are not allowed to do that.
```

Now we need to feed our custom error message strings to the Validator. This may be different for you, depending on how you handle validation, but the basic idea should remain the same.

```php
// src/Sentinel/Service/Validation/AbstractLaravelValidator.php

<?php namespace Sentinel\Service\Validation;

use Illuminate\Validation\Factory;

abstract class AbstractLaravelValidator	implements ValidableInterface {

    /**
     * Validator
     *
     * @var \Illuminate\Validation\Factory
     */
    protected $validator;

    /**
     * Custom Validation Messages
     *
     * @var Array
     */
    protected $messages = array();

    public function __construct(Factory $validator)
    {
        $this->validator = $validator;

        // Retrieve Custom Validation Messages & Pass them to the validator.
        $this->messages = array_dot(trans('Sentinel::validation.custom'));
    }

    // ...
}
```

Here we are establishing a `$messages` class member and loading our custom language strings when the abstract validator class is instantiated. The [language files](https://github.com/rydurham/Sentinel/blob/master/src/lang/en/validation.php#L127-L159) use `Sentinel::validaton.custom` to refer to the array of custom error message strings.

Now all that remains is to pass the messages to the validator when we are attempting to validate data:

```php
// src/Sentinel/Service/Validation/AbstractLaravelValidator.php

abstract class AbstractLaravelValidator	implements ValidableInterface {

    // ...

    /**
     * Validation passes or fails
     *
     * @return boolean
     */
    public function passes()
    {
        $validator = $this->validator->make($this->data, $this->rules, $this->messages);

        if ($validator->fails() )
        {
            $this->errors = $validator->messages();
            return false;
        }

        return true;
    }
}
```

The validator takes three arguments:

1.  An array of data to be validated.
2.  An array of the validation rules for that data.
3.  Optional: An array of custom error messages.

The messages array uses the input and names as array keys, and the corresponding value is the desired message text.

Problem solved!
