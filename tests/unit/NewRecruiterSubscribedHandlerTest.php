<?php

use EriePaJobs\Events\Auth\NewRecruiterSubscribedHandler;
use EriePaJobs\Mailers\NewRecruiterSubscribedWelcomeMailer;
use Laracasts\TestDummy\Factory as TestDummy;

class NewRecruiterSubscribedHandlerTest extends \Codeception\TestCase\Test
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
    public function testNewRecruiterSubscribedHandler()
    {
        $user = TestDummy::create('User', [ 'email' => 'testNewRecruiterSubscriber@example.com ']);
        $newRecruiterSubscribedHandler = new NewRecruiterSubscribedHandler(new NewRecruiterSubscribedWelcomeMailer);
        $newRecruiterSubscribedHandler->handle($user);

        $this->tester->assertEmailSubjectEquals('Welcome to EriePA Jobs');

        $this->tester->assertEmailRecipientContains($user->email);
    }

}