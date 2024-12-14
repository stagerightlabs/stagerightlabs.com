<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Blog\Librarian\Librarian;

class ArticleController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Librarian $librarian, string $slug): string
    {
        if (!$content =  $librarian->fetch($slug)) {
            abort(404);
        }

        return $content;
    }
}
