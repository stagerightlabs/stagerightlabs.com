---
title: Adding Sqids to a Laravel Application
date: 2023-12-02
summary: Sqids is a revised version of Hashids; lets explore using it to obfuscate model Ids in Laravel.
tags:
    - Laravel
    - PHP
---

When constructing a URL for a model resource in a standard Laravel application there are really only two options for unique identifiers: model Ids and slugs. UUIDs are also a possibility but they require some extra configuration so I don't consider them a 'standard' option. Model Ids are convenient but you might not want to expose primary keys to your users, for myriad reasons. It is often the case that slugs are not feasible for certain types of model. Our best bet then is to somehow obfuscate model Ids for the sake of generating resource URLs. This will make it much less obvious how many users are in our database, or how many invoices we have sent. Obfuscation like this is possible but requires a bit of work to integrate with a Laravel application.

For a long time, the best option was a library called [Hashids](https://packagist.org/packages/hashids/hashids), which also has a [Laravel bridge package](https://packagist.org/packages/vinkla/hashids) created by Vincent Klaiber. Recently, however the Hashids project announced the launch of a new tool called [Sqids](https://sqids.org); the spiritual successor to Hashids. This is more than just a rebranding: the underlying algorithm has been simplified and is now Identical across all platforms. A [PHP implementation](https://github.com/sqids/sqids-php) was recently released, created by Ivan Akimov and Vincent Klaiber.

Let's take a look at how we can integrate Sqids with a Laravel application. Our goal will be to allow this integration to be completely transparent with our usage of the framework.

NB: Sqids can be decoded by third parties so they are not good for truly sensitive information. If that is a concern for your application you should consider [an alternative stragey](https://packagist.org/packages/jenssegers/optimus).

## Getting Started

First we will pull in the `sqids/sqids-php` package with Composer:

```sh
composer require sqids/sqids
```

NB: `sqids/sqids-php` requires at least PHP 8.1 and either ext-bcmath or ext-gmp; it has no other dependencies.

Now we will set up a utility class to handle encoding and decoding sqids:

```php
<?php

namespace App\Utility;

use Sqids\Sqids;

final class Sqid
{
  /**
   * Encode an integer as a hashid.
   */
  public static function encode(?int $number): string
  {
    if (is_null($number)) {
      return '';
    }

    return resolve(Sqids::class)->encode([$number]);
  }

  /**
   * Decode a sqid string into an integer.
   */
  public static function decode(string $sqid): int
  {
    return resolve(Sqids::class)->decode($sqid)[0];
  }
}
```

Squids is built to handle arrays; it accepts an array of integers for encoding and returns an array of integers when decoding. In our case we are only interested in single integer values, not arrays, so the utility methods above handles packaging and unpacking the arrays for us. The `resolve()` method is a Laravel tool for fetching classes from the service container.

One nice benefit of Sqids over Hashids is that there is no need for a salt value to randomize the output. It works out of the box without any additional configuration, which may suit your needs just fine. In my case, however, I would like to ensure that all of the generated sqid strings have the same minimum length for the lifetime of my application. This can be achieved by passing in a `minLength` value to the constructor:

```php
(new Sqids(minLength: 6))->encode([1]);
// 'UkLWZg'
```

NB: This is a _minimum_ length, not a specific length.

Additionally, the default "alphabet" of characters used for generating sqid strings contains uppercase and lowercase letters together. I would prefer to use only lowercase letters so I don't have to be concerned about handling case-sensitive URLs.

To achieve these goals we will prepare an instance of the Sqids class that is configured to our liking and bind it to the service container as a singleton so we can resolve it wherever we need it.

## Configuration

Let's create a new service provider to handle our Sqids configuration:

```sh
php artisan make:provider SqidsServiceProvider
```

This will create a new `app/Providers/SqidsServiceProvider` class. We will use the `register` method to handle our configuration:

```php
<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Sqids\Sqids;

class SqidsServiceProvider extends ServiceProvider
{
  const PAD = 7;
  const ALPHABET = 'msd793zjyw5rf8v6qxahpgn1bk0etc4u2';

  /**
   * Register services.
   */
  public function register(): void
  {
    $this->app->singleton(Sqids::class, function () {
      return new Sqids(self::ALPHABET, self::PAD);
    });
  }
}
```

In addition to shortening the alphabet I have also shuffled the order of the letters. This is the recommended method for generating sqid values that are unique to your application. I have also removed the letters 'l', 'i' and 'o' because they look similar to '1' and '0', though you can craft any alphabet you would like.

Make sure you [register](https://laravel.com/docs/10.x/providers#registering-providers) your provider in your `config/app.php` file. With this singleton bound to the service container we are guaranteed to get our configured version of the Squids class any time we resolve it through the container:

```php
$sqid = resolve(Sqids::class)->encode([$number]);
```

## Model Accessor

Rather than having to encode a model Id every time we need to reference a sqid, we can use a model accessor to compute sqids automatically. We will set this up as a trait that can be applied to any model that want to reference with sqids:

```php
<?php

namespace App\Models;

use App\Utility\Sqid;
use Illuminate\Database\Eloquent\Casts\Attribute;

trait HasSqid
{
  /**
   * Get the obfuscated version of the model Id.
   *
   * @see https://sqids.org
   */
  protected function sqid(): Attribute
  {
    return Attribute::make(
      get: fn () => Sqid::encode($this->id)
    );
  }
}
```

NB: I have put this trait in the `App\Models` namespace but you can put it anywhere you want, just make sure to adjust line 3.

Now when we call `$model->sqid` we will get the appropriate sqid version of the model Id based on our configuration specs from earlier.

The last piece of the puzzle is [route model binding](https://laravel.com/docs/10.x/routing#route-model-binding). Can we get Laravel to translate sqids into models for us automatically when handling routes? Let's give it a shot.

## Route Model Binding

We will add two additional methods to our `HasSqid` trait:

```php
/**
 * Get the route key for the model.
 *
 * @return string
 */
public function getRouteKeyName()
{
  return 'sqid';
}
```

This method tells Laravel to use the 'sqid' accessor when generating model routes instead of 'id':

```php
route('some.named.route', $sqidModel);
// https://myapp.com/some/named/route/abc1234
```

Next, we will intercept the route model binding handler to decode the sqid before querying the database:

```php
/**
 * Retrieve the model for a bound value.
 *
 * @param mixed $value
 * @param string|null $field
 * @return \Illuminate\Database\Eloquent\Model|null
 */
public function resolveRouteBinding($value, $field = null)
{
  return $this->resolveRouteBindingQuery($this, Sqid::decode($value), 'id')->first();
}
```

The "value" passed into `resolveRouteBinding` method is the sqid string itself. The "field" is not necessary for our purposes but it relates to [optional key customization](https://laravel.com/docs/10.x/routing#customizing-the-key). In our version of the `resolveRouteBinding` method we are telling Eloquent to find the first database record that has an Id that matches our decoded sqid value.

With those two methods in place we can now add this trait to any model we want and automatically enable the use of sqids for that model and Laravel does all of the heaving lifting for us automatically. Perfect!

Having been a big fan of Hashids for several years now it was delightful to see this new simplified and upgraded version released recently. Ivan and Vincent have done an excellent job on this PHP implementation.
