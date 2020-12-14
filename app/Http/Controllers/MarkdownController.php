<?php

namespace App\Http\Controllers;

use App\Actions\Posts\PostMarkdownRenderingAction;
use App\Post;
use App\Utilities\Flash;
use Illuminate\Support\Facades\Response;

class MarkdownController extends Controller
{
    public function show($slug)
    {
        $post = Post::published()
            ->where('slug', $slug)
            ->first();

        if (! $post) {
            abort(404);
        }

        $markdown = PostMarkdownRenderingAction::execute(['post' => $post]);

        if ($markdown->failed()) {
            Flash::error('There was a problem rendering markdown for that post.');

            return redirect()->route('home');
        }

        // Return our markdown as plain text.
        $response = Response::make($markdown->rendered, 200);
        $response->header('Content-Type', 'text/plain');

        return $response;
    }
}
