<?php

use EriePaJobs\Jobs\JobsRepository;

class SearchController extends \BaseController {


    /**
     * @var JobsRepository
     */
    private $jobsRepo;

    function __construct(JobsRepository $jobsRepo)
    {
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
		return View::make('search.index');
	}

    public function result()
    {
        $term = Input::get('search_term');
        $result = $this->jobsRepo->searchForJob($term);

        dd($result);
        return View::make('search.result', ['results' => $result, 'term' => $term]);
    }

	/**
	 * Show the form for creating a new resource.
	 * GET /search/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /search
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /search/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /search/{id}/edit
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
	 * PUT /search/{id}
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
	 * DELETE /search/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}