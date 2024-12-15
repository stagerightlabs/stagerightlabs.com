---
title: Asset Versioning in Laravel
date: 2021-03-23
summary: Asset versioning helps us ensure that browsers will always use the latest version of our compiled assets when they visit our site. Let's take a look at a strategy for asset versioning in Laravel.
tags:
    - Blade
    - Laravel
---

Laravel Mix provides an asset versioning tool that allows us to ensure that browsers are always pulling in the latest version of our compiled assets. How can we implement cache busting [if we are not using Laravel  Mix](https://stagerightlabs.com/blog/you-might-not-need-laravel-mix)? Here is a strategy that I have found useful.

The key to forcing browsers to update their asset cache is to change the name of the file that is being referenced. Laravel Mix does this by implementing asset fingerprinting; a unique file name is generated for each asset each time you run your mix scripts (in production) and the `mix()` helper method looks up the appropriate name via a `mix-manifest.json` file that is stored in your public path.

We can accomplish something similar by appending a query string parameter to our asset URLs.  To do that we will set up a config value to keep track of our asset version and then use that value as a query parameter when calling our asset files.

To implement this we will first create an `assets.php` config file in our `config/` directory.  This config file will have one value, called "version":

## Generating an Asset Version ID

```php
<?php

return [
    'version' => env('ASSETS_VERSION', null),
];
```

Notice that we are referencing a new`ASSETS_VERSION` environment variable.  Add this key to your `.env` file.  We will set up an artisan command to update the value of the `ASSETS_VERSION` variable for us when needed.  We can crib the functionality for this tool from the `key:generate` command, which performs a very similar task.

```php
<?php

namespace App\Console\Commands;

use App\Utilities\Str;
use Illuminate\Console\Command;
use Illuminate\Console\ConfirmableTrait;

class AssetVersioningCommand extends Command
{
    use ConfirmableTrait;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'assets:version {--force : Force the operation to run when in production}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate an asset version identifier';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $key = $this->generateRandomKey();

        if (! $this->setKeyInEnvironmentFile($key)) {
            return;
        }

        $this->info('Asset version key set successfully.');
    }

    // ...
}
```

The `generateRandomKey()` method will be very simple:

```php
protected function generateRandomKey(): string
{
    return Str::random(16);
}
```

The `setKeyInEnvironmentFile()` method is borrowed directly from the `key:generate` command with some slight modification:

```php
protected function setKeyInEnvironmentFile($key)
{
    $currentKey = $this->laravel['config']['assets.version'];

    if (strlen($currentKey) !== 0 && (!$this->confirmToProceed())) {
        return false;
    }

    $this->writeNewEnvironmentFileWith($key);

    return true;
}
```

The `writeNewEnvironmentFileWith()` method is also borrowed directly from the `key:generate` command:

```php
protected function writeNewEnvironmentFileWith($key)
{
    file_put_contents($this->laravel->environmentFilePath(), preg_replace(
        $this->keyReplacementPattern(),
        'ASSETS_VERSION=' . $key,
        file_get_contents($this->laravel->environmentFilePath())
    ));
}
```

Finally, this is the `keyReplacementPattern()` method, again borrowed from the `key:generate` command:

```php
protected function keyReplacementPattern()
{
    $escaped = preg_quote('=' . $this->laravel['config']['assets.version'], '/');

    return "/^ASSETS_VERSION{$escaped}/m";
}
```

[You can see the complete file here.](https://stagerightlabs.com/snippets/SNR8FWB7) With this command in place, we can generate a new asset version identifier upon each new deployment by adding a call to the `assets:version` command to our deployment script.

## Using the Asset Version ID

Now that we have the asset version ID available to us, we need to update our asset urls to include the ID as a query parameter. We can do that with a custom blade directive. Add this to the `boot()` method of your `AppServiceProvider`:

```php
Blade::directive('version', function($path) {
    return "<?php echo config('assets.version') ? asset({$path}) . '?v=' . config('assets.version') : asset({$path}); ?>";
});
```

This blade directive accepts a partial path to an asset.  It uses the `asset()` url helper to generate a full URL to the asset, then appends our version ID to the url as a query string. If no version is found the query parameter will be omitted.

We will now need to update our layout files to use this directive when loading assets:

```html
<script src="@version('/js/app.js')"></script>
```

We can now reference versioned assets anywhere we need to in our application, and we can ensure that browsers will always pull in the latest version of our assets when we deploy updates.
