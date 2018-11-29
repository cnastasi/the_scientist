<?php

namespace Tests\Unit\Domain\ValueObject;

use LaravelDay\Article\ValueObject\Exception\TitleTooShort;
use LaravelDay\Article\ValueObject\Title;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TitleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @test
     *
     * @return void
     */
    public function shouldCreateATitle()
    {
        $expectedTitle = "This is valid title";

        $title = new Title($expectedTitle);

        $this->assertEquals($expectedTitle, (string)$title);
        $this->assertTrue($title->isEqual(new Title($expectedTitle)));
    }

    /**
     * @test
     */
    public function shouldRaiseTitleTooShortException() {
        $this->expectException(TitleTooShort::class);

        $title = new Title('');

    }
}
