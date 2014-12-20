<?php

use EriePaJobs\Mailers\NewJobPostedMailer;
use Laracasts\TestDummy\Factory as TestDummy;
use EriePaJobs\Events\Jobs\NewJobPostedHandler;

class NewJobPostedHandlerTest extends \Codeception\TestCase\Test
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
        $job = TestDummy::create('Job', [ 'title' => 'Account Manager' ]);
        $user = TestDummy::create('User', ['email' => 'testNewJobHandler@example.com']);

        $newJobPostedHandler = new NewJobPostedHandler(new NewJobPostedMailer);

        $newJobPostedHandler->handle($job, $user);

        $email = $this->tester->getLastEmail();

        $this->tester->assertEmailSubjectEquals('Job Listing Confirmation');

        $this->tester->assertEmailRecipientContains($user->email);
    }

}