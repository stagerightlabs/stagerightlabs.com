<?php

use App\Http\Livewire\Backstage\ {
    PostCreate,
    PostIndex,
    PostPreview,
    PostShow,
    PostUpdate,
    SnippetCreate,
    SnippetIndex,
    SnippetShow,
    SnippetUpdate,
    TagCreate,
    TagIndex,
    TagUpdate,
};
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Snippets
Route::get('snippets', SnippetIndex::class)->name('backstage.snippets.index');
Route::get('snippets/create', SnippetCreate::class)->name('backstage.snippets.create');
Route::get('snippets/{ref}', SnippetShow::class)->name('backstage.snippets.show');
Route::get('snippets/{ref}/edit', SnippetUpdate::class)->name('backstage.snippets.update');

// Tags
Route::get('tags', TagIndex::class)->name('backstage.tags.index');
Route::get('tags/create', TagCreate::class)->name('backstage.tags.create');
Route::get('tags/{ref}/edit', TagUpdate::class)->name('backstage.tags.update');

// Posts
Route::get('posts', PostIndex::class)->name('backstage.posts.index');
Route::get('posts/create', PostCreate::class)->name('backstage.posts.create');
Route::get('posts/{ref}', PostShow::class)->name('backstage.posts.show');
Route::get('posts/{ref}/edit', PostUpdate::class)->name('backstage.posts.update');
Route::get('posts/{ref}/preview', PostPreview::class)->name('backstage.posts.preview');

// Scratch
Route::view('scratch', 'backstage.scratch');
