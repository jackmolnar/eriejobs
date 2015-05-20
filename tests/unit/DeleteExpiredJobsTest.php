<?php

use Laracasts\TestDummy\Factory as TestDummy;

class DeleteExpiredJobsTest extends \Codeception\TestCase\Test
{
   /**
    * @var \UnitTester
    */
    protected $tester;

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests
    public function testDeleteExpiredJobs()
    {
        $expiredJob = TestDummy::create('Job', [
            'expire' => \Carbon\Carbon::today()->subDays(10),
            'active' => 1
        ]);
        $expiredJob->index();

        $activeJob = TestDummy::create('Job', [
            'expire' => \Carbon\Carbon::today()->addDays(10),
            'active' => 1
        ]);
        $activeJob->index();

        $deleteExpiredJobsCommand = new DeleteExpiredJobs;

        $deleteExpiredJobsCommand->fire();

        $expiredJob = $this->tester->grabRecord('jobs', ['id' => $expiredJob->id ]);
        $this->tester->assertTrue($expiredJob->deleted_at != null);

        $this->tester->seeRecord('jobs', ['id' => $activeJob->id]);

        // remove the active and undeleted job from index
        $activeJob->removeIndex();

    }

}