<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Snippets
Route::livewire('snippets', 'backstage.snippet-index')->name('backstage.snippets.index');
Route::livewire('snippets/create', 'backstage.snippet-create')->name('backstage.snippets.create');
Route::livewire('snippets/{ref}', 'backstage.snippet-show')->name('backstage.snippets.show');
Route::livewire('snippets/{ref}/edit', 'backstage.snippet-update')->name('backstage.snippets.update');

// Tags
Route::livewire('tags', 'backstage.tag-index')->name('backstage.tags.index');
Route::livewire('tags/create', 'backstage.tag-create')->name('backstage.tags.create');
Route::livewire('tags/{ref}/edit', 'backstage.tag-update')->name('backstage.tags.update');

// Scratch
Route::view('scratch', 'backstage.scratch');
