<?php

use EriePaJobs\Jobs\JobsRepository;
use EriePaJobs\Jobs\PostNewJobValidator;
use EriePaJobs\Jobs\PostNewJobCommand;

class JobsController extends \BaseController {

    /**
     * @var JobsRepository
     */
    private $jobRepo;

    function __construct(JobsRepository $jobRepo)
    {
        $this->beforeFilter('auth', ['except' => ['index', 'show']]);
        $this->jobRepo = $jobRepo;
    }

    /**
	 * Display a listing of the resource.
	 * GET /jobs
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /jobs/create
	 *
	 * @return Response
	 */
	public function create()
	{
        $categories = Category::dropdownarray();
        $career_levels = CareerLevel::dropdownarray();
        $types = Type::dropdownarray();
        $states = State::dropdownarray();
		return View::make('jobs.create', [
            'states' => $states,
            'types' => $types,
            'career_levels' => $career_levels,
            'categories' => $categories
        ]);

	}

	/**
	 * Store a newly created resource in storage.
	 * POST /jobs
	 *
	 * @return Response
	 */
	public function store()
	{
		$newJobValidator = new PostNewJobValidator(Input::all());
        $valid = $newJobValidator->execute();

        if($valid['status'])
        {
            $newJobCommand = new PostNewJobCommand(Input::all());
            $newJobCommand->execute();
            return Redirect::action('ProfilesController@index')->with('success', 'Job has been posted!');
        }

        return Redirect::back()->withInput()->withErrors($valid['errors']);

	}

	/**
	 * Display the specified resource.
	 * GET /jobs/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$job = $this->jobRepo->getJobById($id);
        return View::make('jobs.show', ['job' => $job]);
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /jobs/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /jobs/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /jobs/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}