<?php

declare(strict_types=1);

namespace Tests\Domain\Models;

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

    #[Test]
    public function it_can_generate_an_index()
    {
        $fs = app()->make('files');
        $librarian = new Librarian(realpath(__DIR__.'/../../stubs/folder'), realpath(__DIR__.'/../../stubs/dist'), $fs);
        $expected = json_decode(file_get_contents(__DIR__.'/../../stubs/expected.json'));

        $index = $librarian->reindex();

        $this->assertEquals($expected, $index->posts->toArray());
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

        $this->assertEquals(realpath(__DIR__.'/../../stubs/dist'), $librarian->dist());
    }

    #[Test]
    public function it_can_purge_cached_html()
    {
        $fs = app()->make('files');
        $librarian = new Librarian(realpath(__DIR__.'/../../stubs/folder'), realpath(__DIR__.'/../../stubs/dist'), $fs);

        $librarian->prepare('story-of-the-door');
        $this->assertFileExists($librarian->dist());

        $librarian->purge();
        $this->assertFileDoesNotExist($librarian->dist());
    }

    public function tearDown(): void
    {
        // Clean up the stubs/dist folder
        foreach (glob(__DIR__.'/../../stubs/dist/*') as $file) {
            if (is_file($file)) {
                unlink($file);
            }
        }
    }
}
