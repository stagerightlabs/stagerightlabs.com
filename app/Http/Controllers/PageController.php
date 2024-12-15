<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Blog\Librarian\Librarian;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Librarian $librarian): string
    {
        if (!$content =  $librarian->fetch($request->path())) {
            abort(404);
        }

        return $content;
    }
}
