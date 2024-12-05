<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Index;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class BlogController extends Controller
{
    /**
     * Display a listing of blog posts.
     */
    public function index(Request $request): View
    {
        if (! Storage::has("blog.json")) {
            abort(404);
        }

        if (!$json = Storage::get('blog.json')) {
            abort(404);
        }

        $index = new Index(json_decode($json));

        $page = $request->integer('page', 1);
        return view('blog.index', [
            'posts' => $index->orderByDate()->paginate('blog.index', $page, 10)
        ]);
    }

    /**
     * Display a blog post.
     */
    public function show(string $slug): string
    {
        if (!$content = Storage::get("blog/{$slug}")) {
            abort(404);
        }

        return $content;
    }
}
;
