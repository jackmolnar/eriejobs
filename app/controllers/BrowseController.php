<?php

use EriePaJobs\Categories\CategoryRepository;
use EriePaJobs\Jobs\JobsRepository;
use EriePaJobs\Users\UserRepository;

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
     * @var UserRepository
     */
    private $userRepo;

    /**
     * @param JobsRepository $jobRepo
     * @param CategoryRepository $catRepo
     * @param UserRepository $userRepo
     */
    function __construct(JobsRepository $jobRepo, CategoryRepository $catRepo, UserRepository $userRepo)
    {
        $this->jobRepo = $jobRepo;
        $this->catRepo = $catRepo;
        $this->userRepo = $userRepo;

        View::share('user', $this->userRepo->authedUser());
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
        // get category from slug
        $categoryTitle = $this->catRepo->getCategoryTitle($category);

        // get the category jobs
        $result = $this->jobRepo->jobsByCategorySlug($category);

        // if logged in, check if user signed up for search term
        if($this->userRepo->authedUser())
        {
            $notification = $this->userRepo->checkNotification($this->userRepo->authedUser(), $categoryTitle);
        } else {
            $notification = false;
        }

        return View::make('Browse.show', ['category' => $result, 'notification' => $notification]);
	}

}