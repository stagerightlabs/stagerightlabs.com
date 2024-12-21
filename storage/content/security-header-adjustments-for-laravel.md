---
title: Adjusting Security Headers in Laravel
date: 2024-12-21
summary: Certain important security headers are not set by default in a fresh Laravel application. We will use a middleware class to add them to an application.
tags: Laravel, Security
---

If you check the security headers of a fresh Laravel application using a tool like [securityheaders.com](https://securityheaders.com) you will notice that a few important headers are not set by default:

These are left to developers to implement because each application will have different needs. To add these headers we will set up a middleware to ensure the headers are set on a response when it leaves the server.

## Creating a Middleware

We can make a new middleware class using artisan:

```shell
$ php artisan make:middleware SetSecurityHeaders
```

You can then register that middleware class in the `bootstrap/app.php` file:

```php
return Application::configure(basePath: dirname(__DIR__))
    // ...
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->web(append: [SetSecurityHeaders::class]);
    })
    // ...
```

In this example we are adding the `SetSecurityHeaders` middleware to the `web` middleware group; but you could also choose to only assign this middleware to specific routes if needed.

## Adding Security Headers

Let's now update out middelware to set the security headers we want to add:

```php
public function handle(Request $request, Closure $next): Response
{
    Vite::useCspNonce();
    $response = $next($request);

    // We will only apply these headers in production
    if (app()->environment('local')) {
        return $response;
    }

    // Strict Transport Security
    // https://scotthelme.co.uk/hsts-the-missing-link-in-tls/
    // https://securinglaravel.com/security-tip-how-strict-is-your-transport-security/
    $response->headers->set(
        'Strict-Transport-Security',
        'max-age=31536000; includeSubDomains',
        $replace = true
    );

    // Content Security Policy
    // https://scotthelme.co.uk/content-security-policy-an-introduction/
    // https://securinglaravel.com/security-tip-getting-started-with-csp/
    $response->headers->set(
        'Content-Security-Policy',
        "script-src 'nonce-".Vite::cspNonce()."' 'strict-dynamic'; object-src 'none'; base-uri 'none'; require-trusted-types-for 'script';"
        $replace = true,
    );

    // Referrer Policy
    // https://scotthelme.co.uk/a-new-security-header-referrer-policy/
    // https://securinglaravel.com/security-tip-is-your-referrer-leaking-information/
    $response->headers->set(
        'Referrer-Policy',
        'strict-origin',
        $replace = true,
    );

    // Permissions Policy
    // https://scotthelme.co.uk/goodbye-feature-policy-and-hello-permissions-policy/
    // https://securinglaravel.com/security-tip-do-you-have-a-permissions-policy/
    $response->headers->set(
        'Permissions-Policy',
        "autoplay=(), battery=(), cross-origin-isolated=(), execution-while-not-rendered=()",
        $replace = true,
    );

    return $response;
}
```

The values listed here are just an example; you will need to tailor these policies to the needs of your application.

Note that we call `$response = $next($request);` first; this ensures that our header changes are applied to the response after the rest of the application has finished its work. You can see also that we are passing in `true` as the third parameter of `$response->headers->set()` this will ensure that any previous values for those headers will be replaced with these new values.

We are also using Vite to manage nonce values for the content security policy; these will automatically be refreshed on every request.

## Resources

- [Securing Laravel](https://securinglaravel.com/security-tip-security-headers-are/)
- [Larave Vite CSP Nonce](https://laravel.com/docs/11.x/vite#content-security-policy-csp-nonce)
- [Security Headers](https://securityheaders.com)
- [Permissions Policy Header Generator](https://www.permissionspolicy.com/)
- [Google Content Security Policy Evaluator](https://csp-evaluator.withgoogle.com/)
