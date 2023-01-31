<?php

use Illuminate\Support\Facades\Mail;

trait MailTracking
{
    protected $emails = [];

    /** @before */
    public function setUpMailTracking()
    {
        Parent::setUp();

        Mail::getSwiftMailer()->registerPlugin(new TetsingMailEventListener($this));
    }

    protected function check_EmailWasSent()
    {
        $this->assertNotEmpty($this->emails, "No email was sent.");

        return $this;
    }

    protected function check_EmailWasNotSent()
    {
        $this->assertEmpty($this->emails, "Email sent must be empty.");

        return $this;
    }

    protected function count_EmailSent($count)
    {
        $emailsSent = count($this->emails);

        $this->assertCount($count, $this->emails, "Expected $count emails to have been sent, but $emailsSent email sent.");

        return $this;
    }

    protected function check_EmailSentTo($recipient, Swift_Message $message = null)
    {
        $this->assertArrayHasKey($recipient, $this->get_Email($message)->getTo(), "No email was sent to $recipient.");

        return $this;
    }

    protected function check_EmailSentFrom($sender, Swift_Message $message = null)
    {
        $this->assertArrayHasKey($sender, $this->get_Email($message)->getFrom(), "No email was sent from $sender.");

        return $this;
    }

    protected function check_EmailBodyEqual($body, Swift_Message $message = null)
    {
        $this->assertEquals($body, $this->get_Email($message)->getBody(), "No email with the provided body was sent.");

        return $this;
    }

    protected function check_EmailBodyContain($word, Swift_Message $message = null)
    {
        $this->assertStringContainsString($word, $this->get_Email($message)->getBody(), "No email body contain => '$word'");

        return $this;
    }

    public function add_NewEmails(Swift_Message $email)
    {
        $this->emails[] = $email;
    }

    protected function get_Email(Swift_Message $message = null)
    {
        return $message ?: $this->get_LastEmail();
    }

    protected function get_LastEmail()
    {
        return end($this->emails);
    }
}

class TetsingMailEventListener implements Swift_Events_EventListener
{
    protected $test;

    public function __construct($test)
    {
        $this->test = $test;
    }

    public function beforeSendPerformed($event)
    {
        $this->test->add_NewEmails($event->getMessage());
    }
}
