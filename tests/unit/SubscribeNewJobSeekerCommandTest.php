<?php

use EriePaJobs\JobSeekers\SubscribeNewJobSeekerCommand;

class SubscribeNewJobSeekerCommandTest extends \Codeception\TestCase\Test
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
    public function testExecute()
    {
        $mockInput = [
            'email' => 'example@example.com',
            'first_name' => 'Brittany',
            'last_name' => 'Gannoe',
            'notifications' => 1,
            'password' => 'bg6686'
        ];

        $subscribeNewSeekerCommand = new SubscribeNewJobSeekerCommand($mockInput);

        $subscribeNewSeekerCommand->execute();

        $seekerRoleId = \Role::where('title', '=', 'Seeker')->first();

        $this->tester->canSeeRecord('users', [
            'email' => $mockInput['email'],
            'first_name' => $mockInput['first_name'],
            'last_name' => $mockInput['last_name'],
            'notifications' => $mockInput['notifications'],
            'role_id' => $seekerRoleId['id']
        ]);

        $this->tester->assertEmailSubjectEquals("Welcome to EriePA Jobs");
    }

}