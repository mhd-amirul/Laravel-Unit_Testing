<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BasicTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function check_word_in_welcome_page()
    {
        $this->get('/')
            ->assertSee("Laravel")
            ->assertStatus(200);
    }

    /** @test */
    public function redirect_this_page()
    {
        $this->get('/about-page')
            ->assertRedirect("/page");
    }

    /** @test */
    public function find_word_in_this_page()
    {
        $this->get('/page')
            ->assertSee("About")
            ->assertStatus(200);
    }
}
