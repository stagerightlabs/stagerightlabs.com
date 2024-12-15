<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Blog\Librarian\Librarian;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Librarian $librarian): \Illuminate\View\View
    {
        // Determine our current page number
        $page = $request->integer('page', 1);

        // Fetch our content index
        $index = $librarian->index();

        // Ensure there are entries in the index
        if ($index->isEmpty()) {
            abort(404);
        }

        return view('home', [
            'posts' => $index->orderByDate()->paginate('home', $page, 5)
        ]);
    }
}
