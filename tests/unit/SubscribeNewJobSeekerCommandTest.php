<?php

use EriePaJobs\JobSeekers\SubscribeNewJobSeekerCommand;

class SubscribeNewJobSeekerCommandTest extends \Codeception\TestCase\Test
{
   /**
    * @var \UnitTester
    */
    protected $tester;

    // tests
    public function testExecute()
    {
        $mockInput = [
            'email' => 'example@example.com',
            'first_name' => 'Brittany',
            'last_name' => 'Gannoe',
            'notifications' => true,
            'password' => 'bg6686'
        ];

        $subscribeNewSeekerCommand = new SubscribeNewJobSeekerCommand($mockInput);

        $subscribeNewSeekerCommand->execute();

        $this->tester->canSeeRecord('users', [
            'email' => $mockInput['email'],
            'first_name' => $mockInput['first_name'],
            'last_name' => $mockInput['last_name'],
            'notifications' => $mockInput['notifications'],
            'role_id' => \Role::where('title', '=', 'Seeker')->first(['id'])
        ]);
    }

}