<?php

use App\Http\Livewire\Backstage\PostCreate;
use App\Http\Livewire\Backstage\PostIndex;
use App\Http\Livewire\Backstage\PostPreview;
use App\Http\Livewire\Backstage\PostShow;
use App\Http\Livewire\Backstage\PostUpdate;
use App\Http\Livewire\Backstage\SeriesCreate;
use App\Http\Livewire\Backstage\SeriesIndex;
use App\Http\Livewire\Backstage\SeriesShow;
use App\Http\Livewire\Backstage\SeriesUpdate;
use App\Http\Livewire\Backstage\SnippetCreate;
use App\Http\Livewire\Backstage\SnippetIndex;
use App\Http\Livewire\Backstage\SnippetShow;
use App\Http\Livewire\Backstage\SnippetUpdate;
use App\Http\Livewire\Backstage\TagCreate;
use App\Http\Livewire\Backstage\TagIndex;
use App\Http\Livewire\Backstage\TagUpdate;
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

// Series
Route::get('series', SeriesIndex::class)->name('backstage.series.index');
Route::get('series/create', SeriesCreate::class)->name('backstage.series.create');
Route::get('series/{ref}', SeriesShow::class)->name('backstage.series.show');
Route::get('series/{ref}/edit', SeriesUpdate::class)->name('backstage.series.update');

// Scratch
Route::view('scratch', 'backstage.scratch');
