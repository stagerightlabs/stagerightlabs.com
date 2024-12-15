<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Blog\Librarian\Librarian;
use Illuminate\Http\Response;

class FeedController extends Controller
{
    public function __invoke(Librarian $librarian): Response
    {
        $feed = $librarian->feed();

        // Ensure there are entries
        if (empty($feed)) {
            abort(404);
        }

        return response($feed)->header('Content-Type', 'text/xml');
    }
}
