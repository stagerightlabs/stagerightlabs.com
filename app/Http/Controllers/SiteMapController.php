<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Blog\Librarian\Librarian;
use Illuminate\Http\Response;

class SiteMapController extends Controller
{
    public function __invoke(Librarian $librarian): Response
    {
        $sitemap = $librarian->siteMap();

        // Ensure there are entries
        if (empty($sitemap)) {
            abort(404);
        }

        return response($sitemap)->header('Content-Type', 'text/xml');
    }
}
