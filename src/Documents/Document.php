<?php

declare(strict_types=1);

namespace Blog\Documents;

/**
 * A value object representing a text document.
 *
 * @property view-string $template
 */
final class Document
{
    /**
     * @codeCoverageIgnore
     * @param string[] $tags
     */
    public function __construct(
        public readonly string $content,
        public readonly string $path = '',
        public readonly ?string $title = null,
        public readonly ?string $slug = null,
        public readonly ?string $summary = null,
        public readonly ?\DateTimeImmutable $date = null,
        public readonly ?string $series = null,
        public readonly ?int $episode = null,
        public readonly array $tags = [],
        public readonly string $template = 'article'
    ) {
    }

    /**
     * Pipe the document through a transformer.
     */
    public function pipe(callable $stage): Document
    {
        return $stage($this);
    }

    /**
     * Create a new document from a file.
     */
    public static function open(string $path): static
    {
        if (! $content = @file_get_contents($path)) {
            throw new \Exception("Could not read file contents: '{$path}'");
        }

        return new static($content, $path);
    }
}
