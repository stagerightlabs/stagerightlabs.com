<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;
use Illuminate\View\View as ViewResponse;

class DeckController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(string $slug): ViewResponse
    {
        if (View::exists("decks.{$slug}")) {
            return view("decks.{$slug}");
        }

        abort(404);
    }
}
