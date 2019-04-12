public function boot()
{
    // ...

    // Establish Translator Namespace
    $this->loadTranslationsFrom(__DIR__ . '/../lang', 'Sentinel');

    // ...
}
