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

// Posts
Route::livewire('posts', 'backstage.post-index')->name('backstage.posts.index');
Route::livewire('posts/create', 'backstage.post-create')->name('backstage.posts.create');
Route::livewire('posts/{ref}', 'backstage.post-show')->name('backstage.posts.show');
Route::livewire('posts/{ref}/edit', 'backstage.post-update')->name('backstage.posts.update');
Route::livewire('posts/{ref}/preview', 'backstage.post-preview')->name('backstage.posts.preview');

// Scratch
Route::view('scratch', 'backstage.scratch');
