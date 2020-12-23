<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class FeedController extends Controller
{
    public function show()
    {
        $posts = Cache::remember('rss.posts', now()->addHours(24), function() {
            return Post::published()
                ->orderByDesc('published_at')
                ->get();
        });

        return response()->view('feed', ['posts' => $posts])
            ->header('Content-Type', 'text/xml');
    }
}
