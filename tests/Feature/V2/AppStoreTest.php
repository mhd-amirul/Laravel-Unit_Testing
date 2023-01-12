<?php

namespace Tests\Feature\V2;

use App\Models\Rate;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AppStoreTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function check_the_most_popular_store()
    {
        Rate::factory(3)->create();
        Rate::factory()->create(["like" => 20]);
        $like = Rate::factory()->create(["like" => 50]);

        $popular = Rate::popular();

        $this->assertEquals($like->id, $popular->first()->id);
        $this->assertCount(3, $popular);
    }
}
