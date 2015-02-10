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
        View::share('user', Auth::user());

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

        return View::make('Browse.index', ['categories' => $categories]);
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

}