<?php

use EriePaJobs\Jobs\PostNewJobCommand;

class PostNewJobCommandTest extends \Codeception\TestCase\Test
{
   /**
    * @var \UnitTester
    */
    protected $tester;
    protected $user;

    protected function _before()
    {
        $this->tester->haveAnAccount()->logIn();

        $this->tester->seeAuthentication();
    }

    protected function _after()
    {
        Session::clear();
    }

    // tests
    public function testExecuteCreate()
    {
        $mockInput = [
            'title' => 'Art Director',
            'description' => 'You must be able to decide how stuff looks.',
            'company_name' => 'Recon Creative',
            'company_address' => '1000 French Street',
            'company_city' => 'Erie',
            'company_state' => 29,
            'salary' => 50000,
            'career_level' => 2,
            'type' => 2,
            'email' => 'example@example.com',
            'length' => 60,
            'confidential' => true,
            'category' => 10
        ];

        $postNewJobCommand = new PostNewJobCommand($mockInput);

        $job = $postNewJobCommand->execute('create');

        $this->tester->assertTrue(Session::has('pending_job'));

        $this->tester->assertEquals($job->title, 'Art Director');

        return $job;

    }

    /**
     * need to figure out how to mock the object stripe uses to test
     */
    public function testExecuteBill()
    {

    }

}