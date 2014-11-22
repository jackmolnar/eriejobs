<?php

use EriePaJobs\Categories\CategoryRepository;
use EriePaJobs\Jobs\JobsRepository;

class BrowseController extends \BaseController {

    /**
     * @var JobsRepository
     */
    private $jobRepo;
    /**
     * @var CategoryRepository
     */
    private $catRepo;

    /**
     * @param JobsRepository $jobRepo
     * @param CategoryRepository $catRepo
     */
    function __construct(JobsRepository $jobRepo, CategoryRepository $catRepo)
    {
        $this->jobRepo = $jobRepo;
        $this->catRepo = $catRepo;
    }

    /**
	 * Display a listing of the resource.
	 * GET /browse
	 *
	 * @return Response
	 */
	public function index()
	{
        $categories = $this->catRepo->getAllCategoriesWithJobCount();

        return View::make('browse.index', ['categories' => $categories]);
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /browse/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /browse
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /browse/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($category)
	{
        $result = $this->jobRepo->jobsByCategorySlug($category);
		return View::make('Browse.show', ['category' => $result]);
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /browse/{id}/edit
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
	 * PUT /browse/{id}
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
	 * DELETE /browse/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}