<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Custom Polymorphic Types
        Relation::morphMap([
            'posts' => 'App\Post',
            'tags' => 'App\Tag',
        ]);

        // Custom Blade Directives
        Blade::directive('version', function ($path) {
            return "<?php echo config('assets.version') ? asset({$path}) . '?v=' . config('assets.version') : asset({$path}); ?>";
        });
    }
}
