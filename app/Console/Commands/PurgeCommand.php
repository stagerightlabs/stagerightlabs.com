<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class PurgeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'purge';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Purge Cloudflare cache';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $apiToken = env('CLOUDFLARE_API_TOKEN');
        $zoneId = env('CLOUDFLARE_ZONE_ID');

        if (empty($apiToken) || empty($zoneId)) {
            $this->error('Cloudflare API credentials not configured. Please set CLOUDFLARE_API_TOKEN and CLOUDFLARE_ZONE_ID environment variables.');
            return self::FAILURE;
        }

        $this->info('Purging Cloudflare cache...');

        try {
            $response = Http::withHeaders([
                'Authorization' => "Bearer {$apiToken}",
                'Content-Type' => 'application/json',
            ])->post("https://api.cloudflare.com/client/v4/zones/{$zoneId}/purge_cache", [
                'purge_everything' => true,
            ]);

            if ($response->successful() && $response->json('success') === true) {
                $this->components->info('Cloudflare cache purged successfully');
                return self::SUCCESS;
            }

            $errors = $response->json('errors', []);
            $errorMessages = array_map(fn ($error) => $error['message'] ?? 'Unknown error', $errors);
            $this->error('Failed to purge Cloudflare cache: '.implode(', ', $errorMessages));
            return self::FAILURE;
        } catch (\Exception $e) {
            $this->error('Error purging Cloudflare cache: '.$e->getMessage());
            return self::FAILURE;
        }
    }
}
