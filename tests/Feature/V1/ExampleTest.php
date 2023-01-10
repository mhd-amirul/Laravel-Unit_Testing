<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /** @test */
    public function check_word_in_welcome_page()
    {
        $this->get('/')
            ->assertSee("Laravel")
            ->assertStatus(200);
    }
}
