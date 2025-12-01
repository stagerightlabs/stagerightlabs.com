<?php

declare(strict_types=1);

namespace Blog\Librarian;

use Blog\Documents\Document;
use Blog\Documents\Index;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Collection;
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
     * Retrieve a prepared document.
     */
    public function fetch(string $slug): ?string
    {
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

        return $content;
    }

    /**
     * Retrieve an index of available documents.
     */
    public function index(): Index
    {
        return $this->reindex();
    }

    /**
     * Generate an index of available documents.
     */
    public function reindex(): Index
    {
        // Generate an index from the documents
        $index = $this->documents()->map(function (Document $document) {
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

        // Deserialize and return
        /** @phpstan-ignore argument.type */
        return new Index($index->values()->toArray());
    }

    /**
     * Return XML for an ATOM feed.
     *
     * @return string
     */
    public function feed(): string
    {
        // Render the posts as XML
        return view('feed', ['documents' => $this->published()])->render();
    }

    /**
     * Return XML for a sitemap.
     *
     * @return string
     */
    public function siteMap(): string
    {
        // Render the posts as XML
        return view('sitemap', ['documents' => $this->published()])->render();
    }

    /**
     * Return a collection of available documents.
     *
     * @return Collection<array-key,Document>
     */
    public function documents(): Collection
    {
        return collect($this->fs->files($this->source))
            // Only consider markdown files
            ->filter(fn ($info) => Str::endsWith($info->getBasename(), '.md'))
            // Hydrate the file contents into Document classes
            ->map(function (SplFileInfo $file) {
                return Document::open($file->getRealPath())
                    ->pipe(new \Blog\Transformers\ParseFrontMatter());
            });
    }

    /**
     * Retrieve all posts that have a publication date.
     *
     * @return Collection<array-key,Document>
     */
    public function published()
    {
        return $this->documents()
            // Only consider documents with publication dates
            ->filter(fn ($document) => !is_null($document->date))
            // Sort the posts by date descending
            ->sort(fn ($a, $b) => $b->date <=> $a->date)
            // Convert the document markdown to HTML
            ->map(function (Document $document) {
                return $document->pipe(new \Blog\Transformers\MarkdownConverter());
            });
    }

}
