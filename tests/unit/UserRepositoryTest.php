<?php


use EriePaJobs\Users\UserRepository;
use Laracasts\TestDummy\Factory as TestDummy;

class UserRepositoryTest extends \Codeception\TestCase\Test
{
   /**
    * @var \UnitTester
    */
    protected $tester;
    protected $userRepo;

    protected function _before()
    {
        $this->userRepo = new UserRepository;
    }

    protected function _after()
    {
    }

    // tests
    public function testUserById()
    {
        $testUser = TestDummy::create('User', [
            'first_name' => 'Jason',
            'last_name' => 'Milner'
        ]);

        $user = $this->userRepo->userById($testUser->id);

        $this->tester->assertEquals($user->first_name, $testUser->first_name);
        $this->tester->assertEquals($user->last_name, $testUser->last_name);
    }

}