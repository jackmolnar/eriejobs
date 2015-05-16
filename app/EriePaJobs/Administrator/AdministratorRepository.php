<?php
/**
 * Created by PhpStorm.
 * User: jackmolnar1982
 * Date: 5/15/15
 * Time: 6:34 PM
 */

namespace EriePaJobs\Administrator;

use EriePaJobs\Blog\BlogRepository;
use EriePaJobs\Jobs\JobsRepository;

class AdministratorRepository {

    /**
     * @var BlogRepository
     */
    private $blogRepo;
    /**
     * @var JobsRepository
     */
    private $jobRepo;

    function __construct(BlogRepository $blogRepo, JobsRepository $jobRepo)
    {
        $this->blogRepo = $blogRepo;
        $this->jobRepo = $jobRepo;
    }

    public function getBlogInfo()
    {
        return $this->blogRepo->allPosts();
    }

    public function getJobInfo()
    {
        return $this->jobRepo->allActiveJobs();
    }
}