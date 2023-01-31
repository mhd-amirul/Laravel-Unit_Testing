<?php

namespace Tests\Feature\V2;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Mail;
use MailTracking;

use Tests\TestCase;

class AppEmailTest extends TestCase
{

    use MailTracking;

    public function make_EmailBuilder($messages = "Hello World")
    {
        Mail::raw($messages, function ($message) {
            $message->from('a@a.com', 'a');
            $message->to('b@b.com', 'b');
        });
    }

    public function test_EmailWasSent()
    {
        $this->make_EmailBuilder();
        $this->check_EmailWasSent();
    }

    public function test_EmailWasNotSent()
    {
        $this->check_EmailWasNotSent();
    }

    public function test_CountEmailsSentEqual()
    {
        $this->make_EmailBuilder();
        $this->make_EmailBuilder();
        $this->count_EmailSent(2);
    }

    public function test_EmailSentToEqual()
    {
        $this->make_EmailBuilder();
        $this->check_EmailSentTo("b@b.com");
    }

    public function test_EmailSentFromEqual()
    {
        $this->make_EmailBuilder();
        $this->check_EmailSentFrom("a@a.com");
    }

    public function test_EmailsSentBodyEqual()
    {
        $this->make_EmailBuilder();
        $this->check_EmailBodyEqual("Hello World");
    }

    public function test_EmailsSentBodyContainTheWord()
    {
        $this->make_EmailBuilder();
        $this->check_EmailBodyContain("Hello");
    }

    public function test_CheckEmailFromRoute()
    {
        $this->get("check-email")
                ->assertOk();
        $this->check_EmailWasSent();
    }
}


