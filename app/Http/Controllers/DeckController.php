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
        /** @var view-string $view */
        $view = "decks.{$slug}";

        if (View::exists($view)) {
            return view($view);
        }

        abort(404);
    }
}
