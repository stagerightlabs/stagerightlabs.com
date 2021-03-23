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
    protected $signature = 'asset:version {--force : Force the operation to run when in production}';

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

    /**
     * Generate a random string for our version key.
     *
     * @return string
     */
    protected function generateRandomKey(): string
    {
        return Str::random(16);
    }

    /**
     * Set the asset version key in the environment file.
     *
     * @param  string  $key
     * @return bool
     */
    protected function setKeyInEnvironmentFile($key)
    {
        $currentKey = $this->laravel['config']['assets.key'];

        if (strlen($currentKey) !== 0 && (! $this->confirmToProceed())) {
            return false;
        }

        $this->writeNewEnvironmentFileWith($key);

        return true;
    }

    /**
     * Write a new environment file with the given key.
     *
     * @param  string  $key
     * @return void
     */
    protected function writeNewEnvironmentFileWith($key)
    {
        file_put_contents($this->laravel->environmentFilePath(), preg_replace(
            $this->keyReplacementPattern(),
            'ASSETS_VERSION='.$key,
            file_get_contents($this->laravel->environmentFilePath())
        ));
    }

    /**
     * Get a regex pattern that will match env APP_KEY with any random key.
     *
     * @return string
     */
    protected function keyReplacementPattern()
    {
        $escaped = preg_quote('='.$this->laravel['config']['assets.version'], '/');

        return "/^ASSETS_VERSION{$escaped}/m";
    }
}
