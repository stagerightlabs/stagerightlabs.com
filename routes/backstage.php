<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::livewire('snippets', 'backstage.snippet-index')->name('backstage.snippets.index');
Route::livewire('snippets/create', 'backstage.snippet-create')->name('backstage.snippets.create');
Route::livewire('snippets/{ref}', 'backstage.snippet-show')->name('backstage.snippets.show');
Route::livewire('snippets/{ref}/edit', 'backstage.snippet-update')->name('backstage.snippets.update');

Route::view('scratch', 'scratch');
