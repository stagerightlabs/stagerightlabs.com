<?php

declare(strict_types=1);

namespace Blog\Librarian;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class LibrarianServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @codeCoverageIgnore
     */
    public function register(): void
    {
        $this->app->singleton(Librarian::class, function (Application $app) {
            return new Librarian(
                storage_path('content'),
                storage_path('app/dist'),
                $this->app->make('files')
            );
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @codeCoverageIgnore
     */
    public function boot(): void
    {
        // Ensure the distribution folder is available
        if (!file_exists(storage_path('app/dist'))) {
            mkdir(storage_path('app/dist'));
        }
    }
}
