public function boot()
{
    // ...

    $this->mergeConfigFrom(__DIR__.'/../config/sentinel.php', 'sentinel');

    // ...
}
