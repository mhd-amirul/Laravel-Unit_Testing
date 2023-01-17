<?php

namespace Tests\Feature\V2;

use Expression;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AppExpressionTest extends TestCase
{
    /** @test */
    public function it_finds_string()
    {
        $regex = Expression::make()->find("www");
        $this->assertTrue($regex->test("www"));

        $regex = Expression::make()->then("www");
        $this->assertTrue($regex->test("www"));
    }

    /** @test */
    public function it_finds_anything()
    {
        $regex = Expression::make()->anything();

        $this->assertTrue($regex->test("foo"));
    }

    /** @test */
    public function it_maybe_has_value()
    {
        $regex = Expression::make()->maybe("http");

        $this->assertTrue($regex->test("http"));
        $this->assertTrue($regex->test(""));
    }

    /** @test */
    public function it_can_chain_method_calls()
    {
        $regex = Expression::make()->find("www")->maybe(".")->then("laracast");

        $this->assertTrue($regex->test("www.laracast"));
        $this->assertFalse($regex->test("wwwXlaracast"));
    }

    /** @test */
    public function it_finds_anything_but()
    {
        $regex = Expression::make()->find("foo")->anythingBut("bar")->then("biz");

        $this->assertTrue($regex->test("foo(HereCanBeAnythingExcept(bar))biz"));
        $this->assertFalse($regex->test("foobarbiz"));
    }

}
