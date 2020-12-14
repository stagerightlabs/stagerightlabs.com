<?php

use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\DeckController;
use App\Http\Controllers\MarkdownController;
use App\Http\Controllers\SiteMapController;
use App\Http\Livewire\ {
    About,
    BlogIndex,
    BlogPost,
    BlogTopic,
};
use App\Http\Livewire\Auth\ {
    Login,
    Passwords\Confirm,
    Passwords\Email,
    Passwords\Reset,
    Verify,
};
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', BlogIndex::class)->name('home');
Route::redirect('/blog', '/');
Route::get('blog/topic/{topic}', BlogTopic::class)->name('blog.topic');
Route::get('blog/{slug}.md', [MarkdownController::class, 'show'])->name('blog.markdown');
Route::get('blog/{slug}', BlogPost::class)->name('blog.post');

Route::get('about', About::class)->name('about');

Route::view('decks', 'decks.index')->name('decks.index');
Route::get('decks/{slug}', [DeckController::class, 'show'])->name('decks.show');

Route::view('projects', 'projects')->name('projects.index');

Route::view('resume', 'resume')->name('resume');

Route::get('sitemap.xml', [SiteMapController::class, 'index'])->name('sitemap');

Route::middleware('guest')->group(function () {
    Route::get('login', Login::class)->name('login');
});

Route::get('password/reset', Email::class)
    ->name('password.request');

Route::get('password/reset/{token}', Reset::class)
    ->name('password.reset');

Route::middleware('auth')->group(function () {
    Route::get('email/verify', Verify::class)
        ->middleware('throttle:6,1')
        ->name('verification.notice');

    Route::get('password/confirm', Confirm::class)
        ->name('password.confirm');
});

Route::middleware('auth')->group(function () {
    Route::get('email/verify/{id}/{hash}', EmailVerificationController::class)
        ->middleware('signed')
        ->name('verification.verify');

    Route::any('logout', LogoutController::class)
        ->name('logout');
});
