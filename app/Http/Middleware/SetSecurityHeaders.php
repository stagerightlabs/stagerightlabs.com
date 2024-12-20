<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetSecurityHeaders
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // We will only apply these headers in production
        if (app()->environment('local')) {
            return $response;
        }

        // Strict Transport Security
        // https://scotthelme.co.uk/hsts-the-missing-link-in-tls/
        $response->headers->set(
            'Strict-Transport-Security',
            'max-age=31536000; includeSubDomains',
            $replace = true
        );

        // Content Security Policy
        // https://scotthelme.co.uk/content-security-policy-an-introduction/
        $response->headers->set(
            'Content-Security-Policy',
            "default-src 'none'; script-src 'self' https://umami.stagerightlabs.com",
            $replace = true,
        );

        // Referrer Policy
        // https://scotthelme.co.uk/a-new-security-header-referrer-policy/
        $response->headers->set(
            'Referrer-Policy',
            'strict-origin',
            $replace = true,
        );

        // Permissions Policy
        // https://scotthelme.co.uk/goodbye-feature-policy-and-hello-permissions-policy/
        $response->headers->set(
            'Permissions-Policy',
            "geolocation: 'none'; midi: 'none'; notifications: 'self'; push: 'none'; sync-hxr: 'self'; microphone: 'none'; camera: 'none'; magnetometer: 'none'; gyroscope: 'none'; speaker: 'none'; vibrate: 'none'; fullscreen: 'self'; payment: 'none';",
            $replace = true,
        );

        return $response;
    }
}
