<?php

declare(strict_types=1);

namespace Tests\Unit\Transformers;

use App\Models\Document;
use App\Transformers\MarkdownConverter;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class MarkdownConverterTest extends TestCase
{
    #[Test]
    public function it_can_convert_markdown()
    {
        $document = Document::open(__DIR__.'/../../../tests/stubs/folder/simple.md')
            ->pipe(new MarkdownConverter());

        $expected = <<<TXT
        <h1>This is a simple example</h1>
        <p>This is a paragraph</p>

        TXT;

        $this->assertEquals($expected, $document->content);
    }
}
