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
	 * Display a listing of the resource.
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
            $result = "Sorry, no results were returned for '".$term."' <br/>Please try another search.";
            return View::make('search.index', ['noResults' => $result, 'term' => $term]);
        }

//        dd($result->title);
//        $result = Paginator::make($result->toArray(), count($result->toArray()), 3);
        $result = $result->paginate(1);
//        $result = Job::paginate(3);



        return View::make('search.index', ['results' => $result, 'term' => $term]);
	}


}