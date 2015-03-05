<?php

use EriePaJobs\Jobs\JobsRepository;

class SearchController extends \BaseController {


    /**
     * @var JobsRepository
     */
    private $jobsRepo;

    function __construct(JobsRepository $jobsRepo)
    {
        View::share('user', Auth::user());
        $this->jobsRepo = $jobsRepo;
    }


    /**
	 * Display a listing of the resource
	 * GET /search
	 *
	 * @return Response
	 */
	public function index()
	{
        $term = Input::get('search_term');
        $result = $this->jobsRepo->searchForJob($term);

        if(count($result) == 0)
        {
            $result = "Sorry, no results were returned for '".$term."'. Please try another search.";
            return View::make('search.index', ['noResults' => $result, 'term' => $term]);
        }

        $result = $result->paginate(20);

        return View::make('search.index', ['results' => $result, 'term' => $term]);
	}


}