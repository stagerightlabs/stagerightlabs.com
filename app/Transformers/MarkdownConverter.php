<?php

declare(strict_types=1);

namespace App\Transformers;

use App\Models\Document;
use League\CommonMark\GithubFlavoredMarkdownConverter;

final class MarkdownConverter
{
    public function __invoke(Document $document): Document
    {
        $converter = new GithubFlavoredMarkdownConverter();

        return new Document(
            strval($converter->convert($document->content)),
            $document->title,
            $document->summary,
            $document->date,
            $document->series,
            $document->episode,
            $document->tags
        );
    }
}
