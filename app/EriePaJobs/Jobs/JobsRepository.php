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
use Config;

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
        $data['jobs'] = $data['category']->jobs->paginate(15);
        return $data;
    }

    /**
     * Get job record by id
     * @param $job_id
     * @return \Illuminate\Database\Eloquent\Model|null|static
     */
    public function getJobById($job_id)
    {
        if(Cache::has('job.all'))
        {
            $allJobs = Cache::get('job.all');
            $job = $allJobs->find($job_id);
            return $job;
        }
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

    public function getCostFromExpireDate($date)
    {
        $listings = Config::get('billing')['listings'];

        $today = Carbon::today();
        $length = $today->diffInDays($date);

        return $listings[$length];
    }

    /**
     * Get all Jobs
     * If stored in cache, return all jobs from there. Else fetch them
     * @return \ElastiquentCollection
     */
    public function allJobs()
    {
        if (Cache::has('job.all'))
        {
            $all_jobs = Cache::get('job.all');
            return $all_jobs;
        }
        $all_jobs = Job::all();
        Cache::put('job.all', $all_jobs, 60);
        return $all_jobs;
    }

    /**
     * Update all jobs cache
     */
    public function updateAllJobsCache()
    {
        Cache::forget('job.all');
        $all_jobs = Job::all();
        Cache::put('job.all', $all_jobs, 60);
    }

    /**
     * Search for a job, if no search term, pull all jobs, else return search results
     * @param string $term
     * @return \Elasticquent\ElasticquentResultCollection
     */
    public function searchForJob($term)
    {
        if($term == ''){
            $result = $this->allJobs()->sortByDesc('created_at');
            return $result;
        }
        $result = Job::search($term);
        return $result;
    }

    /**
     * Deactivate Job
     * @param $id
     */
    public function deactivateJob($id)
    {
        $job = $this->getJobById($id);
        $job->active = 0;
        $job->save();
        $job->removeFromIndex();
    }

    /**
     * Activate Job
     * @param $id
     */
    public function activateJob($id)
    {
        $job = $this->getJobById($id);
        $job->active = 1;
        $job->save();
        $job->addToIndex();
    }

    /**
     * Delete the job by id
     * @param $id
     * @return string
     * @throws \Exception
     */
    public function deleteJob($id)
    {
        $job = $this->getJobById($id);
        $job->delete();
        return true;
    }
}