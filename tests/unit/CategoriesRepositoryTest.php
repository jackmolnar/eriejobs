<?php


use EriePaJobs\Categories\CategoryRepository;
use Laracasts\TestDummy\Factory as TestDummy;

class CategoriesRepositoryTest extends \Codeception\TestCase\Test
{
   /**
    * @var \UnitTester
    */
    protected $tester;
    protected $catRepo;

    protected function _before()
    {
        $this->catRepo = new CategoryRepository;
    }

    protected function _after()
    {
    }

    // tests
    public function testGetAllCategories()
    {
        $currentCategories = $this->catRepo->getAllCategories();

        TestDummy::times(10)->create('Category');

        $newCategories = $this->catRepo->getAllCategories();

        $this->tester->assertEquals(count($currentCategories) + 10, count($newCategories));
    }

    public function testGetAllCategoriesWithJobCount()
    {
        $testCategory = TestDummy::create('Category', [
            'category' => 'Test Job Category'
        ]);

        $jobs = TestDummy::times(10)->create('Job', [
            'active' => 1
        ]);

        foreach($jobs as $job)
        {
            $testCategory->jobs()->attach($job->id);
        }

        $allCategories = $this->catRepo->getAllCategoriesWithJobCount(false);

        foreach($allCategories as $key => $category)
        {
            if($category->category == $testCategory->category)
            {
                $this->tester->assertEquals(count($jobs), $allCategories[$key]['job_count']);
            }
        }
    }

}