<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Vite;
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
        Vite::useCspNonce();
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
            "script-src 'nonce-".Vite::cspNonce()."' https://cdn.seline.com https://static.cloudflareinsights.com 'self'; object-src 'none'; base-uri 'none'; require-trusted-types-for 'script';",
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

        // Cache Control Headers for Cloudflare
        // Use s-maxage for CDN caching (Cloudflare) and max-age for browser caching
        // Uniform 1-day cache for all blog content
        if ($response instanceof Response && $response->getContent()) {
            $content = $response->getContent();
            $etag = md5($content);

            // Check if client sent If-None-Match header and ETags match
            $ifNoneMatch = $request->header('If-None-Match');
            if ($ifNoneMatch && trim($ifNoneMatch, '"') === $etag) {
                // Return 304 Not Modified without body
                return response('', 304)
                    ->withHeaders([
                        'Cache-Control' => 'public, max-age=86400, s-maxage=86400',
                        'ETag' => "\"{$etag}\"",
                    ]);
            }

            $response->headers->set(
                'Cache-Control',
                'public, max-age=86400, s-maxage=86400',
                $replace = true
            );
            $response->headers->set(
                'ETag',
                "\"{$etag}\"",
                $replace = true
            );
        }

        return $response;
    }
}
