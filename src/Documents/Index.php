<?php

declare(strict_types=1);

namespace Blog\Documents;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

final class Index
{
    /**
     * @var Collection<int, \StdClass>
     */
    public Collection $posts;

    /**
     * @param array<int, \StdClass> $posts
     */
    public function __construct(array $posts = [])
    {
        $this->posts = collect($posts);
    }

    /**
     * Is the posts collection empty?
     */
    public function isEmpty(): bool
    {
        return $this->posts->isEmpty();
    }

    /**
     * Retrieve data by slug if present.
     */
    public function get(string $slug): ?\StdClass
    {
        return $this->posts
            ->filter(fn($post) => $post->slug == $slug)
            ->first();
    }

    /**
     * Retrieve a summary of all known series.
     *
     * @return array<string, array<int, array<string, string>>>
     */
    public function series(): array
    {
        return $this->posts->reduce(function (array $carry, \StdClass $post) {
            if (property_exists($post, 'series') && $post->slug) {
                $carry[$post->series][$post->episode] = [
                    'title' => $post->title,
                    'link' => route('article', $post->slug)
                ];
            }
            return $carry;
        }, []);
    }

    /**
     * Sort the document collection by date.
     */
    public function orderByDate(): self
    {
        $this->posts = $this->posts
            ->filter(fn($post) => $post->date)
            ->sort(fn($a, $b) => $b->date <=> $a->date);

        return $this;
    }

    /**
     * Return a subset of documents as a paginator instance.
     *
     * @return LengthAwarePaginator<int, \StdClass>
     */
    public function paginate(string $route, int $page = 1, int $size = 15): LengthAwarePaginator
    {
        // Calculate offset based on the page number and size of each page
        $offset = $page * $size - $size;

        // Build and return custom paginator
        return new LengthAwarePaginator(
            $this->posts->slice($offset, $size),
            $this->posts->count(),
            $size,
            $page,
            ['path' => route($route)]
        );
    }
}
