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
     * Get the length of the listing in days from the expire date
     * @param $date
     * @return int
     */
    public function getLengthFromExpireDate($date)
    {
        $length = Carbon::today()->diffInDays($date);
        return $length;
    }

    /**
     * Get cost of job from Billing config file using the length of the posting
     * @param $date
     * @return mixed
     */
    public function getCostFromExpireDate($date)
    {
        $listings = Config::get('billing')['listings'];

        $length = Carbon::today()->diffInDays($date);

        return $listings[$length];
    }

    /**
     * Get all Jobs
     * If stored in cache, return all jobs from there. Else fetch them
     * @return \ElastiquentCollection
     */
    public function allJobs($cache = true)
    {
        if (Cache::has('job.all') && $cache == true)
        {
            $all_jobs = Cache::get('job.all');
            return $all_jobs;
        }
        $all_jobs = Job::all();
        Cache::put('job.all', $all_jobs, 60);
        return $all_jobs;
    }

    /**
     * Get all active jobs
     * @return \ElastiquentCollection
     */
    public function allActiveJobs()
    {
        $result = $this->allJobs();
        $result = $result->filter(function($result)
        {
            if($result->active == 1)
            {
                return $result;
            }
        });
        return $result;
    }

    /**
     * Get job record by id
     * @param $job_id
     * @return \Illuminate\Database\Eloquent\Model|null|static
     */
    public function getJobById($job_id)
    {
        $allJobs = $this->allJobs();

        if(is_numeric($job_id))
        {
            $job = $allJobs->find($job_id);
        } else {
            $job = Job::findBySlug($job_id);
        }
        return $job;
    }

    /**
     * Search for a job, if no search term, pull all jobs, else return search results
     * @param string $term
     * @return \Elasticquent\ElasticquentResultCollection
     */
    public function searchForJob($term = '', $limit = 100, $offset = null)
    {
        if($term == ''){
            $result = $this->allActiveJobs();
            return $result->sortByDesc('created_at')->take($limit);
        }

        $params = [
            'from' => $offset,
            'size' => $limit,
            'query' => [
                'match' => [
                    '_all' =>  [
                        'query' => $term,
                        "minimum_should_match" => "75%"
                    ]
                ]
            ]
        ];

        $result = Job::search($params);

        return $result;
    }

    /**
     * Get similar jobs
     * @param $job
     * @return \Fadion\Bouncy\ElasticCollection
     * @internal param $term
     */
    public function searchMoreLikeThis($job)
    {
        $result = $this->searchForJob($job->title, 10);

        unset($result[0]);

        return $result;
    }

    /**
     * More jobs from recruiter
     * @param $job
     * @return \Elasticquent\ElasticquentResultCollection
     */
    public function moreJobsFromCompany($job)
    {
        return $result = $this->searchForJob($job->company_name, 10);
    }

    /**
     * Get jobs by the category slug
     * @param string $category_slug
     * @return array $data
     */
    public function jobsByCategorySlug($category_slug)
    {
        $data['category'] = \Category::where('slug', '=', $category_slug)->first();
        $data['jobs'] = $data['category']->jobs()->active()->orderBy('created_at', 'desc')->paginate(20);
        return $data;
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
     * Deactivate Job
     * @param $id
     */
    public function deactivateJob($id)
    {
        $job = $this->getJobById($id);
        $job->active = 0;
        $job->save();
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
