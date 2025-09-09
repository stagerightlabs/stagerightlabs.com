<?php

declare(strict_types=1);

namespace Tests\Domain\Librarian;

use Blog\Documents\Index;
use Blog\Librarian\Librarian;
use Illuminate\Foundation\Testing\TestCase;
use PHPUnit\Framework\Attributes\Test;

class LibrarianTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        if (!file_exists(__DIR__.'/../../stubs/dist')) {
            mkdir(__DIR__.'/../../stubs/dist');
        }
    }

    public function tearDown(): void
    {
        parent::tearDown();

        // Clean up the stubs/dist folder
        foreach (glob(__DIR__.'/../../stubs/dist/*') as $file) {
            if (is_file($file)) {
                unlink($file);
            }
        }
    }

    #[Test]
    public function it_can_generate_an_index()
    {
        $fs = app()->make('files');
        $librarian = new Librarian(realpath(__DIR__.'/../../stubs/folder'), realpath(__DIR__.'/../../stubs/dist'), $fs);
        $expected = json_decode(file_get_contents(__DIR__.'/../../stubs/expected.json'));

        $index = $librarian->reindex();

        $this->assertEquals('2024-01-01', $index->posts()[0]->date);
        $this->assertEquals('Dr. Jekyll and Mr. Hyde', $index->posts()[0]->series);
        $this->assertEquals(1, $index->posts()[0]->episode);
        $this->assertStringEndsWith('tests/stubs/folder/chapter-1.md', $index->posts(0)->source);
        $this->assertCount(3, $index->posts());
    }

    #[Test]
    public function it_can_return_an_index()
    {
        $fs = app()->make('files');
        $librarian = new Librarian(realpath(__DIR__.'/../../stubs/folder'), realpath(__DIR__.'/../../stubs/dist'), $fs);

        $indexA = $librarian->index();
        $indexB = $librarian->index();

        $this->assertInstanceOf(Index::class, $indexA);
        $this->assertInstanceOf(Index::class, $indexB);
    }

    #[Test]
    public function it_can_prepare_html()
    {
        $fs = app()->make('files');
        $librarian = new Librarian(realpath(__DIR__.'/../../stubs/folder'), realpath(__DIR__.'/../../stubs/dist'), $fs);

        $html = $librarian->prepare('story-of-the-door');

        $this->assertStringContainsString('Story of the Door</h1>', $html);
    }

    #[Test]
    public function an_invalid_key_returns_no_html()
    {
        $fs = app()->make('files');
        $librarian = new Librarian(realpath(__DIR__.'/../../stubs/folder'), realpath(__DIR__.'/../../stubs/dist'), $fs);

        $this->assertNull($librarian->prepare('invalid'));
    }

    #[Test]
    public function it_can_return_prepared_html()
    {
        $fs = app()->make('files');
        $librarian = new Librarian(realpath(__DIR__.'/../../stubs/folder'), realpath(__DIR__.'/../../stubs/dist'), $fs);

        $first = $librarian->fetch('story-of-the-door');
        $second = $librarian->fetch('story-of-the-door');

        $this->assertEquals($first, $second);
    }

    #[Test]
    public function it_can_return_the_dist_path()
    {
        $fs = app()->make('files');
        $librarian = new Librarian(realpath(__DIR__.'/../../stubs/folder'), realpath(__DIR__.'/../../stubs/dist'), $fs);

        $this->assertEquals(realpath(__DIR__.'/../../stubs/dist'), $librarian->distPath());
    }

    #[Test]
    public function it_can_purge_cached_html()
    {
        $fs = app()->make('files');
        $librarian = new Librarian(realpath(__DIR__.'/../../stubs/folder'), realpath(__DIR__.'/../../stubs/dist'), $fs);

        $librarian->prepare('story-of-the-door');
        $this->assertFileExists($librarian->distPath());

        $librarian->purge();
        $this->assertFileDoesNotExist($librarian->distPath());
    }

    #[Test]
    public function it_can_prepare_an_rss_feed()
    {
        $fs = app()->make('files');
        $librarian = new Librarian(realpath(__DIR__.'/../../stubs/folder'), realpath(__DIR__.'/../../stubs/dist'), $fs);

        $feedA = $librarian->feed();
        $feedB = $librarian->feed();

        $this->assertStringContainsString('<feed xmlns="http://www.w3.org/2005/Atom">', $feedA);
        $this->assertStringContainsString('<link href="https://stagerightlabs.com/feed" rel="self" />', $feedA);
        $this->assertStringContainsString('<feed xmlns="http://www.w3.org/2005/Atom">', $feedB);
        $this->assertStringContainsString('<link href="https://stagerightlabs.com/feed" rel="self" />', $feedB);
        $this->assertEquals($feedA, $feedB);
    }

    #[Test]
    public function it_can_prepare_a_sitemap_feed()
    {
        $fs = app()->make('files');
        $librarian = new Librarian(realpath(__DIR__.'/../../stubs/folder'), realpath(__DIR__.'/../../stubs/dist'), $fs);

        $feedA = $librarian->siteMap();
        $feedB = $librarian->siteMap();

        $this->assertStringContainsString('<?xml version="1.0" encoding="UTF-8"?>', $feedA);
        $this->assertStringContainsString('xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"', $feedA);
        $this->assertStringContainsString('<loc>http://stagerightlabs.test/blog/search-for-mr-hyde</loc>', $feedA);
        $this->assertStringContainsString('<lastmod>2024-02-01</lastmod>', $feedB);
        $this->assertStringContainsString('<changefreq>monthly</changefreq>', $feedB);
        $this->assertEquals($feedA, $feedB);
    }
}
