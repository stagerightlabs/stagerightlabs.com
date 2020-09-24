<?php

namespace App\Http\Controllers;

use App\Post;

class SiteMapController extends Controller
{
    public function index()
    {
        $expiration = now()->addDay(1);

        $posts = cache()->remember('sitemap.posts', $expiration, function () {
            return Post::whereNotNull('published_at')
                ->orderBy('published_at')
                ->get();
        });

        return response()
            ->view('sitemap', ['posts' => $posts])
            ->header('Content-Type', 'text/xml');
    }
}
