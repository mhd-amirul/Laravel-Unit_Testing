<?php

namespace Tests\Feature\V2;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class homeScreenTest extends TestCase
{
    /** @test */
    public function home_screen_can_be_render()
    {
        $this->get("/home")
            ->assertStatus(200);
    }
}
