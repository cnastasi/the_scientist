<?php

declare(strict_types=1);

namespace Tests\Feature;

use Tests\TestCase;

class MyTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function testExample()
    {
        $response = $this->get('api/test');

        $response->assertStatus(200);
        $response->assertSeeText('It Works');
    }
}
