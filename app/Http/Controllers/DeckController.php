<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;

class DeckController extends Controller
{
    public function show($slug)
    {
        if (View::exists("decks.{$slug}")) {
            return view("decks.{$slug}");
        }

        abort(404);
    }
}
