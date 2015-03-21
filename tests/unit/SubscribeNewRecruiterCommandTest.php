<?php

use EriePaJobs\Recruiters\SubscribeNewRecruiterCommand;

class SubscribeNewRecruiterCommandTest extends \Codeception\TestCase\Test
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
    public function testExecute()
    {
        $mockInput = [
            'email' => 'example@example.com',
            'first_name' => 'Brittany',
            'last_name' => 'Gannoe',
            'password' => 'bg6686'
        ];

        $subscribeNewRecruiterCommand = new SubscribeNewRecruiterCommand($mockInput);

        $subscribeNewRecruiterCommand->execute();

        $recruiterRoleId = \Role::where('title', '=', 'Recruiter')->first();

        $this->tester->canSeeRecord('users', [
            'email' => $mockInput['email'],
            'first_name' => $mockInput['first_name'],
            'last_name' => $mockInput['last_name'],
            'role_id' => $recruiterRoleId['id']
        ]);

        $this->tester->assertEmailSubjectEquals('Welcome to EriePAJobs');
    }

}