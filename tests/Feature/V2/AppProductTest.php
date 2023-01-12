<?php

namespace Tests\Feature\V2;

use App\Http\Controllers\V2\AppProductController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AppProductTest extends TestCase
{
    public function setting()
    {
        return new AppProductController("Hunger Games", 70);
    }

    /** @test */
    public function its_a_same_name_or_not()
    {
        $this->assertEquals("Hunger Games", $this->setting()->product()["name"]);
    }

    /** @test */
    public function its_a_same_cost_or_not()
    {
        $this->assertEquals(70, $this->setting()->product()["cost"]);
    }
}
