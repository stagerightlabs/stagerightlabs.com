<?php

use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\DeckController;
use App\Http\Controllers\FeedController;
use App\Http\Controllers\MarkdownController;
use App\Http\Controllers\SiteMapController;
use App\Http\Livewire\About;
use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Auth\Passwords\Confirm;
use App\Http\Livewire\Auth\Passwords\Email;
use App\Http\Livewire\Auth\Passwords\Reset;
use App\Http\Livewire\Auth\Verify;
use App\Http\Livewire\BlogIndex;
use App\Http\Livewire\BlogPost;
use App\Http\Livewire\BlogTopic;
use App\Http\Livewire\PublicSnippet;
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

// Home Page
Route::get('/', BlogIndex::class)->name('home');
Route::redirect('/blog', '/');

// Redirect for problematic historical URLs
Route::redirect(
    'blog/laravel5-pacakge-development-service-provider',
    '/blog/laravel-5-package-development-the-service-provider',
    301
);
Route::redirect(
    'blog/laravel5-pacakge-development-setup',
    '/blog/laravel-5-package-development-the-service-provider',
    302
);

// Blog Posts
Route::group(['prefix' => 'blog'], function () {
    // Topics
    Route::get('topic/{topic}', BlogTopic::class)->name('blog.topic');
    // A special case to handle historical url redirection
    Route::get('tag:{tag}', function ($tag) {
        return redirect()->route('blog.topic', strtolower($tag));
    });
    // View a blog post as markdown
    Route::get('{slug}.md', [MarkdownController::class, 'show'])->name('blog.markdown');
    // A special case to handle historical url redirection
    Route::get('{slug}.html', function ($slug) {
        return redirect()->route('blog.post', $slug);
    });
    // View a blog post
    Route::get('{slug}', BlogPost::class)->name('blog.post');
});

// Snippets
Route::get('snippets/{ref}', PublicSnippet::class)->name('public.snippet');
Route::redirect('snippets', '/');

// Static Pages
Route::get('about', About::class)->name('about');
Route::view('decks', 'decks.index')->name('decks.index');
Route::get('decks/{slug}.html', function ($slug) {
    return redirect()->route('decks.show', $slug);
});
Route::get('decks/{slug}', [DeckController::class, 'show'])->name('decks.show');
Route::view('projects/{slug?}', 'projects')->name('projects.index');
Route::view('resume', 'resume')->name('resume');

// Ancillary Pages
Route::get('feed', [FeedController::class, 'show'])->name('feed');
Route::redirect('blog.rss', 'feed');
Route::get('sitemap.xml', [SiteMapController::class, 'index'])->name('sitemap');

// Auth and User Accounts
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

// Temporary contact page redirect
Route::redirect('contact', '/about', 302);

// Convert old tag link url to the new format.
Route::get('tag:{tag}', function ($tag) {
    return redirect()->route('blog.topic', strtolower($tag));
});

// Portfolio page redirect
Route::redirect('portfolio', 'resume');
