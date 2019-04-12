// Package Service Provider
class SentinelServiceProvider extends ServiceProvider
{

   // ...

   public function boot()
   {
        // ...

        // Add the Translator Namespace
        $this->app['translator']->addNamespace('Sentinel', __DIR__.'/../lang');
   }

}
