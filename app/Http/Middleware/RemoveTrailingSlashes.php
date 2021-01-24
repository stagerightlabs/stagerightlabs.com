<?php

namespace App\Http\Middleware;

use Closure;

class RemoveTrailingSlashes
{
    /**
     * Remove the trailing slash from the URL, if it is present.
     * https://www.dwightwatson.com/posts/redirect-trailing-slashes-in-laravel-5
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (preg_match('/.+\/$/', $request->getRequestUri())) {
            return redirect(rtrim($request->getRequestUri(), '/'), 301);
        }

        return $next($request);
    }
}
