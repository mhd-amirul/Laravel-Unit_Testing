<?php

namespace Tests\Feature\V2;

use BladeDirective;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Prophecy\PhpUnit\ProphecyTrait;
use RussianCache;
use Tests\TestCase;

class AppPropheciesTest extends TestCase
{
    use ProphecyTrait;

    public function test_basic_prophecies()
    {
        $directive = $this->prophesize(BladeDirective::class);

        $directive->foo("bar")->shouldBeCalled()->willReturn("foobar");

        $response = $directive->reveal()->foo("bar");

        $this->assertEquals("foobar", $response);
    }

    public function test_it_normalizes_a_string_for_cache_key()
    {
        $cache = $this->prophesize(RussianCache::class);

        $directive = new BladeDirective($cache->reveal());

        $cache->has("cache-key")->shouldBeCalled();

        $directive->setUp("cache-key");
    }

    public function test_it_normalizes_a_cacheable_model_for_cache_key()
    {
        $cache = $this->prophesize(RussianCache::class);

        $directive = new BladeDirective($cache->reveal());

        $cache->has("stub-cache-key")->shouldBeCalled();

        $directive->setUp(new ModelStub);
    }

    public function test_it_normalizes_an_array_for_cache_key()
    {
        $cache = $this->prophesize(RussianCache::class);

        $directive = new BladeDirective($cache->reveal());

        $item = ["Kasat", "Mata"];
        $cache->has(md5("KasatMata"))->shouldBeCalled();

        $directive->setUp($item);
    }
}

class ModelStub
{
    public function getCacheKey()
    {
        return "stub-cache-key";
    }
}
