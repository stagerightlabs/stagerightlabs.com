<?php

declare(strict_types=1);

namespace Tests\Unit\Transformers;

use App\Models\Document;
use App\Transformers\ParseFrontMatter;
use DateTimeImmutable;
use Illuminate\Support\Facades\Log;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ParseFrontMatterTest extends TestCase
{
    #[Test]
    public function it_can_read_front_matter()
    {
        $document = Document::open(__DIR__.'/../../../tests/stubs/folder/chapter1.md')
            ->pipe(new ParseFrontMatter());

        $this->assertEquals('Story of the Door', $document->title);
        $this->assertInstanceOf(DateTimeImmutable::class, $document->date);
        $this->assertEquals('2024-01-01', $document->date->format('Y-m-d'));
        $this->assertEquals('Dr. Jekyll and Mr. Hyde', $document->series);
        $this->assertEquals(1, $document->episode);
    }

    #[Test]
    public function it_ignores_files_with_invalid_front_matter()
    {
        Log::shouldReceive('warning')->once();
        $document = Document::open(__DIR__.'/../../../tests/stubs/invalid-yaml.md')
            ->pipe(new ParseFrontMatter());

        $this->assertNull($document->title);
    }

    #[Test]
    public function it_ignores_files_with_no_front_matter()
    {
        $document = Document::open(__DIR__.'/../../../tests/stubs/folder/simple.md')
            ->pipe(new ParseFrontMatter());

        $this->assertNull($document->title);
    }

    #[Test]
    public function it_can_parse_front_matter_with_no_date()
    {
        $document = Document::open(__DIR__.'/../../../tests/stubs/no_date.md')
            ->pipe(new ParseFrontMatter());

        $this->assertNull($document->date);
    }
}
