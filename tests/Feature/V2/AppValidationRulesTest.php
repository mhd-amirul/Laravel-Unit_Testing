<?php

namespace Tests\Feature\V2;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AppValidationRulesTest extends TestCase
{

    public function test_it_send_a_support_rule()
    {
        $this->contact_the_method()->assertOk();
    }

    public function test_it_required_a_name()
    {
        $this->contact_the_method(["name" => ""])->assertSessionHasErrors("name");
    }

    public function test_it_required_a_valid_email()
    {
        $this->contact_the_method(["email" => "not-valid-email"])->assertSessionHasErrors("email");
    }

    public function test_it_required_a_question()
    {
        $this->contact_the_method(["question" => ""])->assertSessionHasErrors("question");
    }

    protected function contact_the_method($atrribute = [])
    {
        $this->withExceptionHandling();

        return $this->post("costumer-service", $this->valid_fields($atrribute));
    }

    protected function valid_fields($overrides = [])
    {
        return array_merge(
            [
                "name" => "Muhammad Amirul",
                "email" => "amirul@gmail.com",
                "question" => "Learning Laravel Testing",
                "verification" => 5,
            ], $overrides
        );
    }
}
