<?php

use EriePaJobs\Events\Applications\NewApplicationSentHandler as Handler;
use EriePaJobs\Mailers\SendNewApplicationConfirmationMailer as Mailer;
use Laracasts\TestDummy\Factory as TestDummy;

class NewApplicationSentHandlerTest extends \Codeception\TestCase\Test
{
   /**
    * @var \UnitTester
    */
    protected $tester;

    protected function _before()
    {
        $this->tester->cleanEmailMessages();
    }

    protected function _after()
    {
        $this->tester->cleanEmailMessages();
    }

    // tests
    public function testEvent()
    {
        $user = TestDummy::create('User', [ 'email' => 'testNewApplicationSent@example.com' ]);
        $job = TestDummy::create('Job');

        $sendNewApplicationHandler = new Handler(new Mailer);

        $sendNewApplicationHandler->handle($user, $job);

        $this->tester->assertEmailSubjectEquals('Your Application Has Been Sent!');

        $this->tester->assertEmailRecipientContains($user->email);
    }

}