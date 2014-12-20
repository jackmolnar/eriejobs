<?php

use EriePaJobs\Auth\LoginUserCommand;
use Laracasts\TestDummy\Factory as TestDummy;

class LoginUserCommandTest extends \Codeception\TestCase\Test
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
        $password = Hash::make('example123');

        TestDummy::create('User', [
            'email' => 'test@example.com',
            'password' => $password
        ]);

        $mockInput = [
            'email' => 'test@example.com',
            'password' => 'example123'
        ];

        $loginUserCommand = new LoginUserCommand($mockInput);

        $result = $loginUserCommand->execute();

        $this->tester->assertTrue($result);

        $this->tester->seeAuthentication();

    }

}