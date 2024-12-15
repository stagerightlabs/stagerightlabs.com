<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Blog\Librarian\Librarian;
use Illuminate\Console\Command;

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
    protected $description = 'Remove cached HTML files';

    /**
     * Execute the console command.
     */
    public function handle(Librarian $librarian): int
    {
        if ($librarian->purge()) {
            $this->components->info("Removed cached content from {$librarian->distPath()}");
            return self::SUCCESS;
        }

        $this->error('Could not purge HTML cache');
        return self::FAILURE;
    }
}
