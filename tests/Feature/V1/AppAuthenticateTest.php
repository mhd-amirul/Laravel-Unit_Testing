<?php

namespace Tests\Feature\V2;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AppAuthenticateTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function register_user_can_be_rendered()
    {
        $this->get("/register")->assertStatus(200);
    }

    /** @test */
    public function register_user_can_be_store()
    {
        $user = User::factory()->make();
        $response = $this->post("register", $user->toArray());

        $this->assertAuthenticated();
        $response->assertRedirect("home");
    }

    /** @test */
    public function login_can_be_rendered()
    {
        $this->get("/login")->assertStatus(200);
    }

    /** @test */
    public function login_redirect_to_home_if_success()
    {
        $user = User::factory()->create();

        $response = $this->post("/login", [
            "email" => $user->email,
            "password" => "password"
        ]);

        $this->assertAuthenticated();

        $response->assertRedirect("home");
    }

    /** @test */
    public function login_redirect_to_login_page_if_failed()
    {
        $user = User::factory()->create();

        $this->post("/login", [
            "email" => $user->email,
            "password" => "wrong-password"
        ]);

        $this->assertGuest();
    }

    /** @test */
    public function user_loggedin_can_be_log_out()
    {
        $this->withExceptionHandling();
        $user = User::factory()->create();

        $this->actingAs($user);

        $this->post("logout")
            ->assertSessionHas("message")
            ->assertRedirect(route("login"));
    }
}
