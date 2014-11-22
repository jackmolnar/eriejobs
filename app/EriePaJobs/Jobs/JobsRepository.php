<?php
/**
 * Created by PhpStorm.
 * User: jackmolnar1982
 * Date: 10/29/14
 * Time: 11:27 PM
 */

namespace EriePaJobs\Jobs;
use Cache;
use Job;
use Carbon\Carbon;

class JobsRepository {

    protected $all_jobs;

    function __construct()
    {
        //playing with collections and caching
//        $this->all_jobs = $this->allJobs();
//        dd($this->all_jobs->first()->id);
    }


    /**
     * Get jobs by the category slug
     * @param string $category_slug
     * @return array $data
     */
    public function jobsByCategorySlug($category_slug)
    {
        $data['category'] = \Category::where('slug', '=', $category_slug)->first();
        $data['jobs'] = $data['category']->jobs;
        return $data;
    }

    /**
     * Get job record by id
     * @param $job_id
     * @return \Illuminate\Database\Eloquent\Model|null|static
     */
    public function getJobById($job_id)
    {
        $job = Job::find($job_id);
        return $job;
    }

    /**
     * Create a Jobs Expire Date
     * @param $length
     * @return static
     */
    public function createExpireDate($length)
    {
        $expire_date = Carbon::now()->addDays($length);
        return $expire_date;
    }

    /**
     * Get all Jobs
     * @return \Illuminate\Database\Eloquent\Collection|mixed|static[]
     */
    public function allJobs()
    {
        if (Cache::has('job.all'))
        {
            $all_jobs = Cache::get('job.all');
            return $all_jobs;
        }
        $all_jobs = Job::all();
        return $all_jobs;
    }

    /**
     * Search for a job
     * @param string $term
     * @return \Elasticquent\ElasticquentResultCollection
     */
    public function searchForJob($term)
    {
        $result = Job::search($term);
        return $result;
    }
} 