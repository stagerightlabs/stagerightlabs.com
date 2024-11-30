<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\Document;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use SplFileInfo;

class Publish extends Command
{
    protected $signature = 'publish';
    protected $description = 'Render the site content into HTML';
    protected string $template;
    protected string $destination;

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->writeBlog();
    }

    protected function writeBlog()
    {
        // Read content files
        $this->template = 'blog.show';
        $this->destination = 'app/blog';
        $documents = collect(File::files(base_path('content/blog')))
            ->filter(fn ($info) => Str::endsWith($info->getBasename(), '.md'))
            ->map($this->hydrate(...));

        // Extract series details
        $series = $this->series($documents);

        // Publish content
        $documents->each(fn (Document $document) => $this->publish($document, $series));

        // Publish blog index
        $index = $documents->map($this->index(...));
        file_put_contents(storage_path('app/blog.json'), json_encode($index));
        $this->info('Created blog index');
    }

    /**
     * Create a document instance from a file object.
     */
    protected function hydrate(SplFileInfo $file): Document
    {
        return Document::open($file->getRealPath())
            ->pipe(new \App\Transformers\ParseFrontMatter())
            ->pipe(new \App\Transformers\MarkdownConverter());
    }

    /**
     * Create an HTML page from a document.
     */
    protected function publish(Document $document, array $series = []): void
    {
        $page = view($this->template, [
            'document' => $document,
            'series' => $series
        ])->render();

        File::put(storage_path("{$this->destination}/{$document->slug()}"), $page);

        $this->info("Published '{$document->title}'");
    }

    /**
     * Extract series details from ac collection of documents.
     */
    protected function series(Collection $documents): array
    {
        return $documents->reduce(function (array $carry, Document $document) {
            if ($document->series) {
                $carry[$document->series][$document->episode] = [
                    'title' => $document->title,
                    'link' => route('blog.show', $document->slug())
                ];
            }
            return $carry;
        }, []);
    }

    /**
     * Extract index details from a document.
     *
     * @return array<string, string|int>
     */
    protected function index(Document $document): array
    {
        return [
            'title' => $document->title,
            'slug' => $document->slug(),
            'summary' => $document->summary,
            'date' => $document->date ? $document->date->format('Y-m-d') : null,
        ];
    }
}
