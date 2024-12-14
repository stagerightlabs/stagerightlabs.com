<?php

declare(strict_types=1);

namespace Tests\Domain\Models;

use Blog\Documents\Document;
use Blog\Transformers\MarkdownConverter;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class DocumentTest extends TestCase
{
    #[Test]
    public function it_can_be_piped_through_transformers()
    {
        $documentA = new Document('# hello world');
        $documentB = $documentA->pipe(new MarkdownConverter());

        $this->assertInstanceOf(Document::class, $documentB);
    }

    #[Test]
    public function it_can_open_files()
    {
        $document = Document::open(__DIR__.'/../../../tests/stubs/folder/simple.md');
        $expected = file_get_contents(__DIR__.'/../../../tests/stubs/folder/simple.md');

        $this->assertEquals($expected, $document->content);
    }

    #[Test]
    public function it_rejects_invalid_paths()
    {
        $this->expectException(\Exception::class);
        @Document::open(__DIR__.'/../simple.md');
    }
}
