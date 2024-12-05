<?php

declare(strict_types=1);

namespace App\Models;

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
    public function __construct(array $posts)
    {
        $this->posts = collect($posts);
    }

    /**
     * Sort the document collection by date.
     */
    public function orderByDate(): self
    {
        $this->posts = $this->posts
            ->filter(fn ($post) => $post->date)
            ->sort(fn ($a, $b) => $b->date <=> $a->date);

        return $this;
    }

    /**
     * Return a subset of documents as a paginator instance.
     *
     * @return LengthAwarePaginator<\StdClass>
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
