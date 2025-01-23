<?php

declare(strict_types=1);

namespace Tests\Domain\Transformers;

use Blog\Documents\Document;
use Blog\Transformers\MarkdownConverter;
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
        <ul class="table-of-contents">
        <li><a href="#this-is-a-simple-example">This is a simple example</a></li>
        </ul>
        <h1><a id="this-is-a-simple-example" href="#this-is-a-simple-example" class="heading-permalink" aria-hidden="true" title="Permalink">#</a>This is a simple example</h1>
        <p>This is a paragraph</p>

        TXT;

        $this->assertEquals($expected, $document->content);
    }
}
