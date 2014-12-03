<?php

use EriePaJobs\Jobs\DeleteJobCommand;
use EriePaJobs\Jobs\JobsRepository;
use EriePaJobs\Jobs\PostNewJobValidator;
use EriePaJobs\Jobs\PostNewJobCommand;
use EriePaJobs\Jobs\UpdateJobValidator;
use EriePaJobs\Jobs\UpdateJobCommand;

class JobsController extends \BaseController {

    /**
     * @var JobsRepository
     */
    private $jobRepo;

    function __construct(JobsRepository $jobRepo)
    {
        View::share('user', Auth::user());
        $this->beforeFilter('auth', ['except' => ['index', 'show']]);
        $this->beforeFilter('jobAuthor', ['only' => ['edit', 'update']]);

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
        $categories = Category::dropdownarray();
        $career_levels = CareerLevel::dropdownarray();
        $types = Type::dropdownarray();
        $states = State::dropdownarray();
        $job = $this->jobRepo->getJobById($id);
        return View::make('jobs.edit', [
            'job' => $job,
            'career_levels' => $career_levels,
            'types' => $types,
            'states' => $states,
            'categories' => $categories
        ]);
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
        $updateJobValidator = new UpdateJobValidator(Input::all());
        $valid = $updateJobValidator->execute();

        if($valid['status'])
        {
            $updateJobCommand = new UpdateJobCommand(Input::all(), $id);
            $updateJobCommand->execute();
            return Redirect::action('JobsController@show', ['id' => $id])->with('success', 'Job has been updated!');
        }

        return Redirect::back()->withInput()->withErrors($valid['errors']);

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
		$deleteJobCommand = new DeleteJobCommand($id);
        $result = $deleteJobCommand->execute();
        if($result['status'])
        {
            return Redirect::action('ProfilesController@index')->with('success', $result['message']);
        }
        return Redirect::back()->withErrors($result['message']);
	}

    /**
     * method to activate and deactivate jobs
     * @return string
     */
    public function active()
    {
        $active = Input::get('active');
        $id = Input::get('jobid');

        if($active == 0)
        {
            $this->jobRepo->deactivateJob($id);
        }

        $this->jobRepo->activateJob($id);
    }


}