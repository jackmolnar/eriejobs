<?php

use EriePaJobs\Events\Auth\NewSeekerSubscribedHandler;
use EriePaJobs\Mailers\NewSeekerSubscribedWelcomeMailer;
use Laracasts\TestDummy\Factory as TestDummy;

class NewSeekerSubscribedHandlerTest extends \Codeception\TestCase\Test
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
        $user = TestDummy::create('User', [ 'email' => 'testNewSeekerSubscriber@example.com ']);
        $newSeekerSubscribedHandler = new NewSeekerSubscribedHandler(new NewSeekerSubscribedWelcomeMailer);
        $newSeekerSubscribedHandler->handle($user);

        $this->tester->assertEmailSubjectEquals('Welcome to EriePAJobs');

        $this->tester->assertEmailRecipientContains($user->email);
    }

}