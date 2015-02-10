<?php


use EriePaJobs\Jobs\JobsRepository;
use Carbon\Carbon;
use Laracasts\TestDummy\Factory as TestDummy;

class JobsRepositoryTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    protected $jobRepo;

    protected function _before()
    {
        $this->jobRepo = new JobsRepository;
    }

    protected function _after()
    {
    }

    // tests
    public function testJobsByCategorySlug()
    {
        $categoryOverrides = [
            'category' => 'Administration',
            'active' => 1,
            'slug' => 'administration'
        ];

        $category = TestDummy::create('Category', $categoryOverrides);

        $jobs = TestDummy::times(8)->create('Job');

        foreach($jobs as $job)
        {
            $category->jobs()->attach($job->id);
        }

        $categorySlug = 'administration';

        $result = $this->jobRepo->jobsByCategorySlug($categorySlug);

        $this->tester->assertEquals('Administration', $result['category']->category);
        $this->tester->assertEquals( 8, count($result['jobs']));

    }

    public function testGetJobById()
    {
        $jobOverrides = [
            'title' => 'Human Resources Manager',
        ];

        $job = TestDummy::create('Job', $jobOverrides);

        $result = $this->jobRepo->getJobById($job->id);

        $this->tester->assertEquals('Human Resources Manager', $result->title);
    }

    public function testCreateExpireDate()
    {
        $listing_length = 60;

        $today = Carbon::now();

        $result = $this->jobRepo->createExpireDate($listing_length);

        $this->tester->assertEquals($today->addDays(60), $result);
        $this->tester->assertNotEquals($today->addDays(30), $result);
    }

    public function testGetLengthFromExpireDate()
    {
        $expire_date = Carbon::now()->addDays(60);

        $result = $this->jobRepo->getLengthFromExpireDate($expire_date);

        $this->tester->assertEquals(60, $result);
    }

    public function testGetCostFromExpireDate()
    {
        $cost_array = [
            'listings' => [
                '30' => 12500,
                '60' => 15000
            ]
        ];

        Config::set('test_billing', $cost_array);

        $expireDate = Carbon::now()->addDays(60);

        $result = $this->jobRepo->getCostFromExpireDate($expireDate);

        $this->tester->assertEquals(15000, $result);
    }

    public function testAllJobs()
    {
        $currentJobTotal = $this->jobRepo->allJobs(false);

        $jobs = TestDummy::times(30)->create('Job');

        $allJobs = $this->jobRepo->allJobs(false);

        $this->tester->assertEquals(30 + count($currentJobTotal), count($allJobs));

        //should test cache
    }

    public function testAllActiveJobs()
    {
        $activeJobTotal = Job::where('active', '=', 1);

        $jobs = TestDummy::times(30)->create('Job', [
            'active' => 0
        ]);

        $allJobs = Job::all();

        $this->tester->assertNotEquals($allJobs, $activeJobTotal);

        //should test cache
    }

    public function testUpdateAllJobsCache()
    {
        $currentAllJobs = Cache::get('jobs.all');

        $newJobs = TestDummy::times(10)->create('Job');

        $this->jobRepo->updateAllJobsCache();

        $this->tester->assertNotEquals(count($newJobs), count($currentAllJobs));

        $this->tester->assertEquals(count($currentAllJobs) + 10, count($currentAllJobs) + count($newJobs));
    }

    public function testSearchForJob()
    {
        $newJob = TestDummy::create('Job', [
            'title' => 'Electrical Engineer',
            'active' => 1
        ]);

        // add to search index
        $newJob->addToIndex();

        $this->tester->seeRecord('jobs', ['title' => $newJob->title]);

        $result = $this->jobRepo->searchForJob('Electrical Engineer');

        $this->tester->assertGreaterThan(0, count($result), "Need job record with Electrical Engineer title to pass");

        // remove from search index
        $newJob->removeFromIndex();
    }

    public function testDeactivateJob()
    {
        $job = TestDummy::create('Job', [
            'active' => 1
        ]);

        // add to search index
        $job->addToIndex();

        $this->jobRepo->deactivateJob($job->id);

        $job = $this->tester->grabRecord('jobs', [
            'id' => $job->id
        ]);

        $this->tester->assertEquals(0, $job->active);
    }

    public function testActivateJob()
    {
        $job = TestDummy::create('Job', [
            'active' => 0
        ]);

        $this->jobRepo->activateJob($job->id);

        $job = $this->tester->grabRecord('jobs', [
            'id' => $job->id
        ]);

        $this->tester->assertEquals(1, $job->active);
    }

    public function testDeleteJob()
    {
        $job = TestDummy::create('Job', [
            'title' => 'Electrician'
        ]);

        // add to search index
        $job->addToIndex();

        $this->tester->seeRecord('jobs', [
            'title' => $job->title
        ]);

        // delete job and removes from index
        $this->jobRepo->deleteJob($job->id);

        $this->tester->dontSeeRecord('jobs', [
            'title' => $job->title
        ]);

    }


}