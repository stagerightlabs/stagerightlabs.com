<?php

declare(strict_types=1);

namespace Tests\Feature\Http\Controllers;

use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class BlogControllerTest extends TestCase
{
    #[Test]
    public function it_throws_a_404_on_unknown_slugs()
    {
        $response = $this->get(route('blog.show', 'unknown-slug'));

        $response->assertStatus(404);
    }
}
