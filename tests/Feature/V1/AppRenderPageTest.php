<?php

namespace Tests\Feature\V2;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AppRenderPageTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function home_screen_can_be_render_if_authenticated()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $this->get("/home")->assertStatus(200);
    }

    /** @test */
    public function home_screen_can_not_be_render_if_not_authenticated()
    {
        $this->get("/home")->assertRedirect(route("login"));
    }
}
