<?php

use Laracasts\TestDummy\Factory as TestDummy;
use EriePaJobs\Jobs\UpdateJobCommand;

class UpdateJobCommandTest extends \Codeception\TestCase\Test
{
   /**
    * @var \UnitTester
    */
    protected $tester;

    protected function _before()
    {
        $this->tester->haveAnAccount()->logIn();

        $this->tester->seeAuthentication();
    }
    // tests
    public function testExecute()
    {
        $category = TestDummy::create('Category');
        $job = TestDummy::create('Job', [
            'user_id' => Auth::user()->id,
            'title' => 'Finance Director',
            'active' => 1
        ]);

        // add mock job from index
        $job->addToIndex();

        $job->categories()->sync([$category->id]);

        $mockInput = [
            'id' => $job->id,
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
            'link' => '',
            'length' => 60,
            'confidential' => 0,
            'category' => $category->id,
        ];

        $updateJobCommand = new UpdateJobCommand($mockInput, $mockInput['id']);

        $updatedJob = $updateJobCommand->execute();

        $this->tester->seeRecord('jobs', [
            'title' => $mockInput['title'],
            'description' => $mockInput['description'],
            'company_name' => $mockInput['company_name'],
            'company_address' => $mockInput['company_address'],
            'company_city' => $mockInput['company_city'],
            'state_id' => $mockInput['company_state'],
            'salary' => $mockInput['salary'],
            'career_level_id' => $mockInput['career_level'],
            'type_id' => $mockInput['type'],
            'email' => $mockInput['email'],
            'confidential' => $mockInput['confidential'],
        ]);

        // remove mock job from index
        $job->removeFromIndex();
    }

}