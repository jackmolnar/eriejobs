<?php

use EriePaJobs\Users\DeleteAccountCommand;
use Laracasts\TestDummy\Factory as TestDummy;

class DeleteAccountCommandTest extends \Codeception\TestCase\Test
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
    public function testDeleteAccountCommand()
    {
        $user = TestDummy::create('User');
        TestDummy::times(5)->create('Notification', [
            'user_id' => $user->id
        ]);

        $this->tester->seeRecord('users', ['id' => $user->id]);

        $this->tester->seeRecord('notifications', ['user_id' => $user->id]);

        $deleteAccountCommandTest = new DeleteAccountCommand($user->id);

        $deleteAccountCommandTest->execute();

        $user = $this->tester->grabRecord('users', ['id' => $user->id ]);

        $this->tester->assertTrue($user->deleted_at != null);

        $this->tester->dontSeeRecord('notifications', ['user_id' => $user->id]);
    }

}