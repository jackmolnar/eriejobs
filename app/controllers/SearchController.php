<?php

use EriePaJobs\Jobs\JobsRepository;
use EriePaJobs\Users\UserRepository;
use Aloha\Twilio\Twilio;

class SearchController extends \BaseController {


    /**
     * @var JobsRepository
     */
    private $jobsRepo;
    /**
     * @var UserRepository
     */
    private $userRepo;

    function __construct(JobsRepository $jobsRepo, UserRepository $userRepo)
    {
        $this->jobsRepo = $jobsRepo;
        $this->userRepo = $userRepo;
        View::share('user', $this->userRepo->authedUser());
    }


    /**
	 * Display a listing of the resource
	 * GET /search
	 *
	 * @return Response
	 */
	public function index()
	{
        // search for term
        $term = Input::get('search_term');
        $result = $this->jobsRepo->searchForJob($term);

        // if logged in, check if user signed up for search term
        if($this->userRepo->authedUser())
        {
            $notification = $this->userRepo->checkNotification($this->userRepo->authedUser(), $term);
        } else {
            $notification = false;
        }

        if(count($result) == 0)
        {
            $result = "Sorry, no results were returned for '".$term."'. Please try another search.";
        }

        $result = $result->paginate(20);

        return View::make('search.index', ['results' => $result, 'term' => $term, 'notification' => $notification]);
	}


}