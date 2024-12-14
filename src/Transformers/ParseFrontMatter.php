<?php

declare(strict_types=1);

namespace Blog\Transformers;

use Blog\Documents\Document;
use Blog\Support\Arr;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Symfony\Component\Yaml\Exception\ParseException;
use Symfony\Component\Yaml\Yaml;

final class ParseFrontMatter
{
    public function __invoke(Document $document): Document
    {
        // @see https://stackoverflow.com/q/7052611
        $content = preg_split('/[\n]*[-]{3}[\n]/', $document->content, 3, PREG_SPLIT_NO_EMPTY);

        // If no front matter was found we will return early
        if ($content === false || count($content) == 1) {
            return $document;
        }

        // Attempt to parse the YAML front matter
        try {
            $yaml = Yaml::parse($content[0]);
        } catch (ParseException $e) {
            Log::warning(sprintf('Unable to parse the YAML string: %s', $e->getMessage()));

            return $document;
        }

        // Instantiate a date instance if necessary
        $date = array_key_exists('date', $yaml)
            ? new \DateTimeImmutable("@{$yaml['date']}", new \DateTimeZone('UTC'))
            : null;

        return new Document(
            content: $content[1],
            path: $document->path,
            title: Str::apa(Arr::string($yaml, 'title')),
            slug: Arr::string($yaml, 'slug', Str::slug(Arr::string($yaml, 'title'))),
            summary: Arr::string($yaml, 'summary'),
            date: $date,
            series: Arr::string($yaml, 'series'),
            episode: Arr::integer($yaml, 'episode'),
            tags: Arr::array($yaml, 'tags') ?? [],
            template: Arr::string($yaml, 'template', 'article')
        );
    }
}
