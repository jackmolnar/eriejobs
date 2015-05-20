<?php

use Laracasts\TestDummy\Factory as TestDummy;
use EriePaJobs\Jobs\DeleteJobCommand;

class DeleteJobCommandTest extends \Codeception\TestCase\Test
{
   /**
    * @var \UnitTester
    */
    protected $tester;
    protected $user;

    protected function _before()
    {
        $this->user = $this->tester->haveAnAccount()->logIn();

        $this->tester->seeAuthentication();
    }

    protected function _after()
    {
    }

    // tests
    public function testExecute()
    {
        $job = TestDummy::create('Job', [
            'title' => 'test delete job',
            'user_id' => $this->user->user->id,
            'active' => 1
        ]);
        $job->index();

        $this->tester->seeRecord('jobs', ['title' => 'test delete job']);

        $deleteJobCommand = new DeleteJobCommand($job->id);

        $result = $deleteJobCommand->execute();

        $job = $this->tester->grabRecord('jobs', ['id' => $job->id ]);
        $this->tester->assertTrue($job->deleted_at != null);

        $this->tester->assertTrue($result['status']);
    }

    /**
     * Test a failed execution
     * Fails because user is not an author of the job
     */
    public function testFailedExecution()
    {
        $otherUser = TestDummy::create('User');

        $job = TestDummy::create('Job', [
            'title' => 'test delete job',
            'user_id' => $otherUser->id,
            'active' => 1
        ]);
        $job->index();

        $this->tester->seeRecord('jobs', ['title' => 'test delete job']);

        $deleteJobCommand = new DeleteJobCommand($job->id);

        $result = $deleteJobCommand->execute();

        $this->tester->seeRecord('jobs', ['title' => 'test delete job']);
        $this->tester->assertFalse($result['status']);
        $job->removeIndex();

    }

}