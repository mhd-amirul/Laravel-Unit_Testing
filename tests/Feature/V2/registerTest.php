<?php

namespace Tests\Feature\V2;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class registerTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function register_user_can_be_render()
    {
        $this->get("/register")
            ->assertStatus(200);
    }

    /** @test */
    public function register_user_can_be_store()
    {
        $user = User::factory()->make();
        $response = $this->post("register", $user->toArray());

        $this->assertAuthenticated();
        $response->assertRedirect("home");
    }
}
