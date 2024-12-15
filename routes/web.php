<?php

declare(strict_types=1);

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\DeckController;
use App\Http\Controllers\FeedController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SiteMapController;
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

Route::get('/', HomeController::class)->name('home');
Route::redirect('/blog', '/');
Route::get('blog/{slug}', ArticleController::class)->name('article');
Route::get('about', PageController::class)->name('about');
Route::get('decks', PageController::class)->name('decks');
Route::get('resume', PageController::class)->name('resume');
Route::get('projects', PageController::class)->name('projects');
Route::get('decks', PageController::class)->name('decks.index');
Route::get('decks/{slug}', DeckController::class)->name('decks.show');
Route::redirect('blog.rss', 'feed');
Route::get('feed', FeedController::class)->name('feed');


// // Ancillary Pages
//
//
// Route::get('sitemap.xml', [SiteMapController::class, 'index'])->name('sitemap');

// // Redirect for problematic historical URLs
// Route::redirect(
//     'blog/laravel5-pacakge-development-service-provider',
//     '/blog/laravel-5-package-development-the-service-provider',
//     301
// );
// Route::redirect(
//     'blog/laravel5-pacakge-development-setup',
//     '/blog/laravel-5-package-development-the-service-provider',
//     302
// );
