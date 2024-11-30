<?php

declare(strict_types=1);

namespace App\Transformers;

use App\Models\Document;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Yaml\Exception\ParseException;
use Symfony\Component\Yaml\Yaml;

final class ParseFrontMatter
{
    public function __invoke(Document $document): Document
    {
        // @see https://stackoverflow.com/q/7052611
        $content = preg_split('/[\n]*[-]{3}[\n]/', $document->content, 3, PREG_SPLIT_NO_EMPTY);

        // If no front matter was found we will return early
        if (count($content) == 1) {
            return $document;
        }

        // Attempt to parse the YAML front matter
        try {
            $yaml = Yaml::parse($content[0]);
        } catch (ParseException $e) {
            Log::warning(sprintf('Unable to parse the YAML string: %s', $e->getMessage()));

            return $document;
        }

        $title = array_key_exists('title', $yaml) ? $yaml['title'] : null;
        $summary = array_key_exists('summary', $yaml) ? $yaml['summary'] : null;
        $date = array_key_exists('date', $yaml)
            ? new \DateTimeImmutable("@{$yaml['date']}", new \DateTimeZone('UTC'))
            : null;
        $series = array_key_exists('series', $yaml) ? $yaml['series'] : null;
        $episode = array_key_exists('episode', $yaml) ? $yaml['episode'] : null;
        $tags = array_key_exists('tags', $yaml) ? $yaml['tags'] : [];

        return new Document(
            $content[1],
            $title,
            $summary,
            $date,
            $series,
            $episode,
            $tags,
        );
    }
}
