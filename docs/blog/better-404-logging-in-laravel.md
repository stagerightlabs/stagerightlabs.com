---
title: 'Better 404 Logging in Laravel'
published: true
date: '17-03-2017 16:14'
layout: BlogPost
categories:
	- Laravel
highlight:
    theme: tomorrow
---

Out of the box, Laravel provides an excellent methodology for handling exceptions that occur in your applications. However, I sometimes find that the default handling of 404 errors is not very helpful for resolving problematic URLs. It turns out this is very easy to implement with a few minor tweaks.

<!-- more -->

Every Laravel 5.\* has an `App/Exceptions/Handler` class that allows us to customize how exceptions are reported and how they are displayed to the user ([More info here](https://laravel.com/docs/5.4/errors#the-exception-handler).) This class extends a framework class called `Illuminate\Foundation\Exceptions\Handler` which is where most of the specifics of how errors are handled can be found. In our application `Handler` class, there are two key methods: `report()` and `render()`. As the documentation tells us, the render method determines how an exception should be shown to a user. This is important because we want to be able to display an error in a way that makes the most sense for the context in which it was encountered. An ajax call will most likely want a json response, whereas an http call will want an html response. A command line exception might want something completely different. The default reporting method most likely already does 99% of what you might want it to do.

For now, we are more interested in the `report()` method. This method is specifically intended as a tool for customizing how we log errors. By default, Laravel disables the reporting of Http errors (such as 404) by including `Symfony\Component\HttpKernel\Exception\HttpException::class` in the `$dontReport` list. We could just comment out that line, but that won't acually help us accomplish our goal. When a 404 error is handled to the logger, you get something like this:

```shell
[2017-03-17 22:51:00] local.ERROR: Symfony\Component\HttpKernel\Exception\NotFoundHttpException in /home/vagrant/example.com/vendor/laravel/framework/src/Illuminate/Routing/RouteCollection.php:161
Stack trace:
#0 /home/vagrant/example.com/vendor/laravel/framework/src/Illuminate/Routing/Router.php(533): Illuminate\Routing\RouteCollection->match(Object(Illuminate\Http\Request))
... lots of other stuff ...
#14 /home/vagrant/example.com/public/index.php(53): Illuminate\Foundation\Http\Kernel->handle(Object(Illuminate\Http\Request))
```

Which doesn't actually tell us what url has caused the problem. Instead, lets update our custom `report()` method to give us more details:

```php
use use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/...

public function report(Exception $exception)
{
	if ($exception instanceof NotFoundHttpException && $request = request()) {
		Bugsnag::notifyError('404', 'Page Not Found', function ($report) use ($request) {
			$report->setSeverity('info');
			$report->setMetaData([
				'url' => $request->url()
			]);
		});
	}

	parent::report($exception);
}
```

Here we check the exception type before handing it off to the parent class report() method. If it is an instance of `NotFoundHttpException` and we have access to a valid request object, we log the url that has caused the problem. I am using Bugsnag in this example, but you could just as easily use another service or the default Monolog logger that Laravel provides. The main benefit to this method is that it allows us to log exactly the information we are looking for in whatever way we want to.

`NotFoundHttpException` is a [Symfony class](http://api.symfony.com/2.3/Symfony/Component/HttpKernel/Exception/NotFoundHttpException.html) that represents a 404 error. Laravel uses the Symfony Http handler behind the scenes. There are lots of features in Laravel that are provided by the Symfony classes used by Laravel, and most of the are essentially undocumented - at least within the Laravel ecosphere. I highly reccomend digging into the source code where you can to discover helpful gems and insights.
