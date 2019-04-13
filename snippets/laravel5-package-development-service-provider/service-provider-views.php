public function boot()
{
    // ...

    // Establish Views Namespace
    if (is_dir(base_path() . '/resources/views/packages/rydurham/sentinel')) {
        // The package views have been published - use those views.
        $this->loadViewsFrom(base_path() . '/resources/views/packages/rydurham/sentinel', 'Sentinel');
    } else {
        // The package views have not been published. Use the defaults.
        $this->loadViewsFrom(__DIR___ . '/../views/bootstrap', 'sentinel');
    }

    // ...
}
