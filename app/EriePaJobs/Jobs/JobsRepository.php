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
use Session;

class JobsRepository {

    /**
     * Create a Jobs Expire Date
     * @param $length
     * @return static
     */
    public function createExpireDate($length)
    {
        return $expire_date = Carbon::now()->addDays($length);
    }

    /**
     * Get the length of the listing in days from the expire date
     * @param $date
     * @return int
     */
    public function getLengthFromExpireDate($date)
    {
        return $length = Carbon::today()->diffInDays($date);
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
     * Get cost based on job description of reader job
     * @param $description
     * @return int|mixed
     */
    public function getCostFromDescriptionLength($description)
    {
        $noSpaces = str_replace(' ', '', $description);

        if(strlen($noSpaces) > Config::get('billing.reader.freeCharacters'))
        {
            return $cost = (strlen($noSpaces)*Config::get('billing.reader.costPerCharacter'))*100;
        }

        return Config::get('billing.reader.baseCost')*100;
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
     * Get deleted job
     *
     * @param $job_id
     * @return \Illuminate\Database\Eloquent\Model|null|static
     */
    public function getTrashedJobById($job_id)
    {
        return $job = Job::withTrashed()->where('slug', '=', $job_id)->first();
    }

    /**
     * Get recent jobs (last 10 jobs)
     * @return mixed
     */
    public function getRecentJobs()
    {
        $allJobs = $this->allActiveJobs();
        return $allJobs->sortByDesc('created_at')->take(10);
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

        return $result = Job::search($params);
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

        // remove original job from results
        unset($result[0]);

        return $result;
    }

    /**
     * Get more jobs by company
     * @param $job
     * @return mixed
     */
    public function moreByCompany($job)
    {
        // get jobs by company
        $recruiter_jobs = $job->byCompany($job->company_name)->limit(10)->get();

        // filter out original job
        $recruiter_jobs = $recruiter_jobs->filter(function($recruiter_job) use ($job)
        {
            if($recruiter_job->id != $job->id) return $recruiter_job;
        });

        return $recruiter_jobs;
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
        $job->subscription = 0;
        $job->save();
        $job->delete();
        return true;
    }

    /**
     * Create payment dropdown array
     * @param int $listingsLeft
     * @return array
     */
    public function paymentDropDownArray($listingsLeft = 0)
    {
        $dropDownArray = array();
        $listing_array = Config::get('billing.listings');

        if(Config::get('billing.free') || $listingsLeft)
        {
            foreach($listing_array as $length => $cost)
            {
                $dropDownArray[$length] = $length.' Days';
            }
            return $dropDownArray;
        }

        foreach($listing_array as $length => $cost)
        {
            $formatted_cost = number_format(($cost/100), 2);
            $dropDownArray[$length] = $length.' Days ($'.$formatted_cost.')';
        }
        return $dropDownArray;
    }

    /**
     * Get pending EPJ job from session
     * @return null
     */
    public function getPendingEpjJob()
    {
        if(Session::has('pending_epj'))
        {
            $pending_job = Session::get('pending_epj');
            return $pending_job;
        }

        return null;
    }

    /**
     * Get pending reader job from the session
     * @return mixed|null
     */
    public function getPendingReaderJob()
    {
        if(Session::has('pending_reader'))
        {
            $pending_job = Session::get('pending_reader');
            return $pending_job;
        }

        return null;
    }

    /**
     * Store EPJ Job in the session
     * @param $job
     */
    public function storeEpjJob($job)
    {
        Session::put('pending_epj', $job);
    }

    /**
     * Store Reader job in the session
     * @param $job
     */
    public function storeReaderJob($job)
    {
        Session::put('pending_reader', $job);
    }

    /**
     * Put job in cart
     * @param $job
     */
    public function putJobInCart($package)
    {
        if(Session::has('cart'))
        {
            $cart = Session::get('cart');
            array_push($cart, $package);
        } else {
            $cart = array();
            array_push($cart, $package);
        }
        Session::put('cart', $cart);
    }

    /**
     * Remove job from cart
     * @param $jobId
     */
    public function removeFromCart($jobId)
    {
        $cart = Session::get('cart');
        foreach($cart as $id => $job)
        {
            if($id == $jobId) unset($cart[$id]);
        }
        Session::put('cart', $cart);
    }

    /**
     * Remove package from cart
     * @param $packageId
     */
    public function removePackageFromCart($packageId)
    {
        $cart = Session::get('cart');
        foreach($cart as $id => $package)
        {
            if($id == $packageId) unset($cart[$id]);
        }
        Session::put('cart', $cart);
    }

    /**
     * Retrieve job from cart
     * @param $jobId
     * @return null
     */
    public function getJobFromCart($jobId)
    {
        $cart = Session::get('cart');
        foreach($cart as $id => $job)
        {
            $job = ($id == $jobId) ? $job : null;
        }
        return $job;
    }

    public function getPackageFromCart($packageId)
    {
        $cart = Session::get('cart');
        foreach($cart as $id => $package)
        {
            $package = ($id == $packageId) ? $package : null;
        }
        return $package;
    }

    /**
     * Mark jobs in cart as part of subscription or not
     * @param $listingsLeft
     * @return mixed
     */
    public function markSubscribedJobs($listingsLeft)
    {
        $cart = Session::get('cart');
        foreach($cart as $index => $job)
        {
            $job->subscription = 0;

            if($listingsLeft > 0) $job->subscription = 1;

            $listingsLeft--;
        }
        return $cart;
    }

    /**
     * Calculate total cost of whats in cart
     * @param $cart
     * @return int|string
     */
    public function calculateCost($cart, $listingsLeft = 0)
    {
        $totalCost = 0;
        foreach($cart as $package)
        {
            $cost = $this->getCostFromDescriptionLength($package['reader']->description);
            $totalCost += $cost;
        }
        return $totalCost;
    }
}
