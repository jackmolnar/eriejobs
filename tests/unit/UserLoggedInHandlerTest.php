<?php

use EriePaJobs\Events\Auth\UserLoggedInHandler;
use Carbon\Carbon;

class UserLoggedInHandlerTest extends \Codeception\TestCase\Test
{
   /**
    * @var \UnitTester
    */
    protected $tester;
    protected $timeBenchmark;

    protected function _before()
    {
        $this->tester->haveAnAccount()->logIn();
        $this->tester->seeAuthentication();
    }

    protected function _after()
    {
    }

    // tests
    public function testEvent()
    {
        $userLoggedInHandler = new UserLoggedInHandler();

        $userLoggedInHandler->handle();

        $loggedInTime = Auth::user()->last_login;

        $this->tester->assertEquals($loggedInTime, Carbon::now());
    }

}