<?php

declare(strict_types=1);

namespace Blog\Transformers;

use Blog\Documents\Document;
use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\Extension\GithubFlavoredMarkdownExtension;
use League\CommonMark\Extension\HeadingPermalink\HeadingPermalinkExtension;
use League\CommonMark\Extension\TableOfContents\TableOfContentsExtension;
use League\CommonMark\MarkdownConverter as CommonMarkConverter;
use Tempest\Highlight\CommonMark\HighlightExtension;

final class MarkdownConverter
{
    public function __invoke(Document $document): Document
    {
        // Prepare CommonMark configuration
        $config = [
            'heading_permalink' => [
                'html_class' => 'heading-permalink',
                'id_prefix' => '',
                'fragment_prefix' => '',
                'symbol' => '#',
                'title' => "Permalink",
            ],
            'table_of_contents' => [
                'html_class' => 'table-of-contents',
                'position' => 'before-headings',
                'normalize' => 'relative',
                'placeholder' => null,
            ],
        ];

        // Prepare a CommonMark converter
        $environment = (new Environment($config))
            ->addExtension(new CommonMarkCoreExtension())
            ->addExtension(new GithubFlavoredMarkdownExtension())
            ->addExtension(new HighlightExtension());

        if ($document->template == 'article') {
            $environment = $environment
                ->addExtension(new TableOfContentsExtension())
                ->addExtension(new HeadingPermalinkExtension());
        }

        $converter = new CommonMarkConverter($environment);

        // Return a new Document instance with HTML content
        return new Document(
            content: strval($converter->convert($document->content)),
            path: $document->path,
            title: $document->title,
            slug: $document->slug,
            summary: $document->summary,
            date: $document->date,
            series: $document->series,
            episode: $document->episode,
            tags: $document->tags,
            template: $document->template,
        );
    }
}
