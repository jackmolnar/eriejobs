<?php


use EriePaJobs\Jobs\JobsRepository;
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
        $jobs = TestDummy::times(20)->create('Job');

        $category->jobs()->sync($jobs);

        $categorySlug = 'administration';

        $result = $this->jobRepo->jobsByCategorySlug($categorySlug);

        $this->tester->assertEquals('Administration', $result['category']->category);
        $this->tester->assertEquals( 20, count($result['jobs']));

    }

}