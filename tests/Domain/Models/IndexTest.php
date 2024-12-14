<?php

declare(strict_types=1);

namespace Tests\Domain\Models;

use Blog\Documents\Index;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Foundation\Testing\TestCase;
use PHPUnit\Framework\Attributes\Test;

class IndexTest extends TestCase
{
    #[Test]
    public function it_can_be_instantiated()
    {
        $stub = file_get_contents(__DIR__.'/../../../tests/stubs/index.json');
        $index = new Index(json_decode($stub));

        $this->assertInstanceOf(Index::class, $index);
        $this->assertCount(3, $index->posts);
    }

    #[Test]
    public function it_knows_when_it_is_empty()
    {
        $empty = new Index();
        $full = new Index(['foo' => 'bar']);

        $this->assertTrue($empty->isEmpty());
        $this->assertFalse($full->isEmpty());
    }

    #[Test]
    public function it_can_retrieve_items_by_slug()
    {
        $stub = file_get_contents(__DIR__.'/../../../tests/stubs/index.json');
        $index = new Index(json_decode($stub));
        $entry = $index->get('story-of-the-door');
        $default = $index->get('unknown');

        $this->assertEquals('Story of the Door', $entry->title);
        $this->assertNull($default);
    }

    #[Test]
    public function it_can_summarize_series_groups()
    {
        $stub = file_get_contents(__DIR__.'/../../../tests/stubs/index.json');
        $index = new Index(json_decode($stub));
        $expected = [
            "Dr. Jekyll and Mr. Hyde" => [
                1 => [
                    "title" => "Story of the Door",
                    "link" => "http://stagerightlabs.test/blog/story-of-the-door"
                ],
                2 => [
                    "title" => "Search for Mr. Hyde",
                    "link" => "http://stagerightlabs.test/blog/search-for-mr-hyde"
                ]
            ]
        ];

        $this->assertEquals($expected, $index->series());
    }

    #[Test]
    public function it_can_order_posts_by_date()
    {
        $stub = file_get_contents(__DIR__.'/../../../tests/stubs/index.json');
        $index = new Index(json_decode($stub));

        $this->assertEquals('2024-01-01', $index->posts->first()->date);
        $this->assertEquals('2024-02-01', $index->orderByDate()->posts->first()->date);
        $this->assertCount(2, $index->orderByDate()->posts);
    }

    #[Test]
    public function it_can_paginate()
    {
        $stub = file_get_contents(__DIR__.'/../../../tests/stubs/index.json');
        $index = new Index(json_decode($stub));
        $pagination = $index->paginate('home', 1, 1);

        $this->assertInstanceOf(LengthAwarePaginator::class, $pagination);
    }
}
