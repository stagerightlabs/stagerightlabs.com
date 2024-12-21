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
            "default-src 'self'; script-src https://umami.stagerightlabs.com; connect-src https://umami.stagerightlabs.com",
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
            "accelerometer=(), ambient-light-sensor=(), autoplay=(), battery=(), camera=(), cross-origin-isolated=(), display-capture=(), document-domain=(), encrypted-media=(), execution-while-not-rendered=(), execution-while-out-of-viewport=(), fullscreen=(), geolocation=(), gyroscope=(), keyboard-map=(), magnetometer=(), microphone=(), midi=(), navigation-override=(), payment=(), picture-in-picture=(), publickey-credentials-get=(), screen-wake-lock=(), sync-xhr=(), usb=(), web-share=(), xr-spatial-tracking=()",
            $replace = true,
        );

        return $response;
    }
}
