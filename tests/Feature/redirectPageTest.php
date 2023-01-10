<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class redirectPageTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function redirect_this_page()
    {
        $this->get('/about-page')
            ->assertRedirect("/page");
            // ->assertStatus(200);
    }

    /** @test */
    public function find_word_in_this_page()
    {
        $this->get('/page')
            ->assertSee("About")
            ->assertStatus(200);
    }
}
