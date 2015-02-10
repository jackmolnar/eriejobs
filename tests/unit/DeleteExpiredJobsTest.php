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
        $expiredJob->addToIndex();

        $activeJob = TestDummy::create('Job', [
            'expire' => \Carbon\Carbon::today()->addDays(10),
            'active' => 1
        ]);
        $activeJob->addToIndex();

        $deleteExpiredJobsCommand = new DeleteExpiredJobs;

        $deleteExpiredJobsCommand->fire();

        $this->tester->dontSeeRecord('jobs', ['id' => $expiredJob->id]);

        $this->tester->seeRecord('jobs', ['id' => $activeJob->id]);

        // remove the active and undeleted job from index
        $activeJob->removeFromIndex();

    }

}