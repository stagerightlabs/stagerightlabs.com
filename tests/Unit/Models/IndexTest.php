<?php

declare(strict_types=1);

namespace Tests\Unit\Models;

use App\Models\Index;
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
        $pagination = $index->paginate('blog.index', 1, 1);

        $this->assertInstanceOf(LengthAwarePaginator::class, $pagination);
    }
}
