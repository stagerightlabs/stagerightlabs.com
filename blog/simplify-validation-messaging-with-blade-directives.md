---
title: 'Simplify Validation Messaging with Blade Directives'
date: '2017-11-15 21:23'
layout: BlogPost
tags:
	- Laravel
---



I am a big fan of templating tools, and Laravel's [Blade](https://laravel.com/docs/5.5/blade) templating system in particular. Given that PHP itself was originally conceived as a templating language you might think that using an additional layer of templating on top of PHP is a bit ironic, but I do think there is a real benefit. We as developers often get caught up in the details of the applications we are building and can sometimes forget that these applications will (hopefully) have a lifespan that goes beyond the work of a single developer. Anything we can do to simplify the cognitive overhead required to bring new developers on-board will go a long way towards keeping our codebase alive and healthy. When used correctly, templating systems like Twig, Mustache or Blade can be a very effective for this purpose.

<!-- more -->






As you may know, the form data validation provided by Laravel is very powerful and robust. However, it occurred to me the other day that there is one area that still feels a bit messy and overly complicated. When displaying error messages to users, some developers prefer to show all of the error messages at the top of the form - this is very easy to do and Laravel makes it a snap to implement. However, other developers prefer to show the errors within the body of the form, so that each message appears next to its corresponding input. To do that, you have to set up your form inputs to look something like this:

~~~ @/snippets/simplify-validation-messaging-with-blade-directives/default-error-messaging.php

In this example, which makes use of Bootstrap 4, we first check the `$errors` Message Bag to see if this input has any messages available. If so, we add the `is-invalid` class to the input. After that we check the errors again to see if this input has any messages, and then we display that message. By default, the messages are delivered back as plain text, but by passing in a formating method we get back the message as html formatted as indicated. This is very handy when working within a CSS framework that has specific requirements about how validation messages should be displayed.

This feels messy to me. There is a lot going on there, and having to specify the message format repeatedly for each input on the form seems needlessly redundant. How can we simplify this? How about a custom [blade directive](https://laravel.com/docs/5.5/blade#extending-blade)?

Add this to your `AppServiceProvider` (or any place that is loaded before views are rendered):

```php
<?php

Blade::directive('error', function($key) {
	$key = str_replace(['\'', '"'], '', $key);
	$errors = session()->get('errors') ?: new \Illuminate\Support\ViewErrorBag;

	if ($message = $errors->first($key)) {
		return "<?php echo '<div class=\"invalid-feedback\">{$message}</div>'; ?>";
	}
});

?>
```

This allows us to simplify our input like so:

```html
<div class="form-group">
	<label for="input-title">Title</label>
	<input type="text" name="title" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" id="input-title" >
	@error('title')
</div>
```

We have wrapped up our error message display logic a single reusable bundle. When we receive the key from the blade compiler it is delivered as a raw string that includes the single quotes, like so: `'title'`. The first step is stripping out the quotation marks. After that we resolve the error message bag out of the session. If there is no message bag available we new one up instead. After that we return the content of the validation message formatted, in this case, for Bootstrap 4.

This is all well and good, but I think we can take it one step further. Most applications have a helpers file for collecting utility functions. (I am a big fan of [this technique](https://stackoverflow.com/a/28360186).) If you have one available, toss this in there:

```php
if (! function_exists('hasError')) {
	/**
	 * Check for the existence of an error message and return a class name
	 *
	 * @param  string  $key
	 * @return string
	 */
	function hasError($key)
	{
		$errors = session()->get('errors') ?: new \Illuminate\Support\ViewErrorBag;

		return $errors->has($key) ? 'is-invalid' : '';
    }
}
```

It would be nice to set this up as a blade directive as well but because we want to keep it on the same line as the input tag itself, a blade directive is not an option; a helper function makes more sense. I am not quite sure that `hasError` is the right name for this - if you have any inspired ideas let me know in the comments. Regardless, with that method in place, we can now update our input like so:

```html
<div class="form-group">
	<label for="input-title">Title</label>
	<input type="text" name="title" class="form-control {{ hasError('title')  }}" id="input-title" >
	@error('title')
</div>
```

This feels much cleaner to me.

It is important to note that by using this blade directive we are not actually changing how messages are displayed - the methodology remains the same. All we are doing is isolating some of the clutter in the template file and hopefully making it easier to read and understand by future developers.

While we are at it, there is one more custom directive you might find useful:

```php
<?php
Blade::directive('errors', function() {
	$errors = session()->get('errors') ?: new \Illuminate\Support\ViewErrorBag;
	return "<?php echo '<pre>" . print_r($errors->getMessages(), true) . "</pre>'; ?>";
});
?>
```

This is a utility method for quickly echoing all of the currently available error messages to the screen, when used like this:

```html
@errors
```

If you ever find yourself with a form that is not passing validation but no error messages are being displayed, this tool can tell you if there are any messages not being displayed.

You might think that these ideas would be good candidates for inclusion in the Laravel Framework directly, but I disagree. If these were provided by the framework they would be much harder to customize between applications, requiring more layers of code and cognitive overhead to keep working properly. It is much simpler to just toss them in to an application when needed and customize them directly. No muss no fuss. This is exactly why Taylor set up the ability to create custom Blade directives in the first place.

If you run into any trouble adding this to your project, remember that the docs recommend flushing your view cache any time you edit your blade directives, via `php artisan view:clear`.
