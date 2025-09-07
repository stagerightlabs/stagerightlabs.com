<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Contracts\Console\PromptsForMissingInput;

class MakeArticleCommand extends Command implements PromptsForMissingInput
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:article {slug}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new markdown file for an article';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $slug = $this->argument('slug');

        if (!str_ends_with($slug, '.md')) {
            $slug .= '.md';
        }

        $path = storage_path("content/{$slug}");

        if (file_exists($path)) {
            $this->error("Article {$slug} already exits");
            return;
        }

        $stream = fopen($path, 'w');
        fwrite($stream, $this->template());

        fclose($stream);
        $this->info("Created {$path}");
    }

    /**
     * The template text for the new article file.
     */
    private function template(): string
    {
        $today = new \DateTimeImmutable()->format('Y-m-d');

        return <<<TXT
        ---
        title:
        date: {$today}
        summary:
        tags:
            - foo
            - bar
        ---
        TXT;
    }

    /**
     * Prompt for missing input arguments using the returned questions.
     *
     * @return array<string, string>
     */
    protected function promptForMissingArgumentsUsing(): array
    {
        return [
            'slug' => 'What slug should we use for the new article?',
        ];
    }
}
