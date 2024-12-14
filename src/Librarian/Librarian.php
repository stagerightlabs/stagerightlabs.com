<?php

declare(strict_types=1);

namespace Blog\Librarian;

use Blog\Documents\Document;
use Blog\Documents\Index;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use SplFileInfo;

final class Librarian
{
    /**
     * @codeCoverageIgnore
     */
    public function __construct(
        protected string $source,
        protected string $dist,
        protected Filesystem $fs
    ) {
    }

    /**
     * Retrieve a prepared document if available, otherwise have it prepared.
     */
    public function fetch(string $slug): ?string
    {
        if ($content = @file_get_contents("{$this->dist}/{$slug}")) {
            return $content;
        }

        return $this->prepare($slug);
    }

    /**
     * Convert a markdown document into HTML
     */
    public function prepare(string $slug): ?string
    {
        // Fetch our article index
        $index = $this->index();

        // Retrieve information about the requested slug
        if (!$info = $index->get($slug)) {
            return null;
        }

        // Open the source document
        $document = Document::open($info->source)
            ->pipe(new \Blog\Transformers\ParseFrontMatter())
            ->pipe(new \Blog\Transformers\MarkdownConverter());

        // Render the document as HTML
        $content = view($document->template, [
            'document' => $document,
            'series' => $index->series()
        ])->render();

        // Cache the HTML on disk
        $this->fs->put("{$this->dist}/{$slug}", $content);

        return $content;
    }

    /**
     * Retrieve an index of available documents.
     */
    public function index(): Index
    {
        if (!$content = @file_get_contents("{$this->dist}/blog.json")) {
            return $this->reindex();
        }

        return new Index(json_decode($content));
    }

    /**
     * Generate an index of available documents and write it to disk.
     */
    public function reindex(): Index
    {
        // Read the available documents from the source directory
        $documents = collect($this->fs->files($this->source))
            // Only consider markdown files
            ->filter(fn ($info) => Str::endsWith($info->getBasename(), '.md'))
            // Hydrate the file contents into Document classes
            ->map(function (SplFileInfo $file) {
                return Document::open($file->getRealPath())
                    ->pipe(new \Blog\Transformers\ParseFrontMatter());
            });

        // Generate an index from the documents
        $index = $documents->map(function (Document $document) {
            return [
                'title' => $document->title,
                'slug' => $document->slug,
                'summary' => $document->summary,
                'date' => $document->date ? $document->date->format('Y-m-d') : null,
                'series' => $document->series,
                'episode' => $document->episode,
                'source' => $document->path,
            ];
        });

        // Write the index to disk
        file_put_contents("{$this->dist}/blog.json", json_encode($index));

        // Deserialize and return
        /** @phpstan-ignore argument.type */
        return new Index(json_decode(file_get_contents("{$this->dist}/blog.json")));
    }

    /**
     * Retrieve the distribution folder path.
     *
     * @return string
     */
    public function dist(): string
    {
        return $this->dist;
    }

    /**
     * Remove all cached HTML.
     *
     * @return string
     */
    public function purge(): bool
    {
        return $this->fs->deleteDirectory($this->dist);
    }
}
