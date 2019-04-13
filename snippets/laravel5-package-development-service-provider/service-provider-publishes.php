public function boot()
{
    // ...

    $this->publishes([
        __DIR__.'/path/to/file1.php' => base_path('location/in/main/application/file1.php'),
        __DIR__.'/path/to/directory' => base_path('location/in/main/application/directory'),
        // Add as items as you want, pointing to any location.
        // Works with both files and directories
    ]);

    // ...
}
