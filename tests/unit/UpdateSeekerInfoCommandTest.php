<?php

use Laracasts\TestDummy\Factory as TestDummy;
use EriePaJobs\JobSeekers\UpdateSeekerInfoCommand;

class UpdateSeekerInfoCommandTest extends \Codeception\TestCase\Test
{
   /**
    * @var \UnitTester
    */
    protected $tester;

    // tests
    public function testExecute()
    {
        $user = TestDummy::create('User', [
            'role_id' => \Role::where('title', '=', 'Seeker')->first(['id'])
        ]);

        $mockInput = [
            'first_name' => 'Jackson',
            'last_name' => 'Milner',
            'email' => 'jonm@glit.edu'
        ];

        $this->tester->seeRecord('users', [
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'email' => $user->email
        ]);

        $updateSeekerInfoCommand = new UpdateSeekerInfoCommand($mockInput, $user->id);

        $updateSeekerInfoCommand->execute();

        $this->tester->seeRecord('users', [
            'first_name' => $mockInput['first_name'],
            'last_name' => $mockInput['last_name'],
            'email' => $mockInput['email']
        ]);

        $this->tester->dontSeeRecord('users', [
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'email' => $user->email
        ]);
    }

}