<?php

use EriePaJobs\Blog\BlogRepository;
use EriePaJobs\Jobs\JobsRepository;
use EriePaJobs\Users\UserRepository;
use yajra\Datatables\Datatables;

class AdministratorController extends \BaseController {

	/**
	 * @var UserRepository
	 */
	private $userRepo;
	/**
	 * @var JobsRepository
	 */
	private $jobRepo;
	/**
	 * @var BlogRepository
	 */
	private $blogRepo;

	function __construct(UserRepository $userRepo, JobsRepository $jobRepo, BlogRepository $blogRepo)
	{
		$this->userRepo = $userRepo;
		$this->jobRepo = $jobRepo;
		$this->blogRepo = $blogRepo;
		$this->user = $this->userRepo->authedUser();
	}


	/**
	 * Display a listing of the resource.
	 * GET /administrator
	 *
	 * @return Response
	 */
	public function index()
	{
//		$allJobs = $this->jobRepo->allActiveJobs();
		return View::make('administrator.index', ['user' => $this->user]);
	}

	public function blog()
	{
		$allPosts = $this->blogRepo->allPosts();
		return View::make('administrator.blog', ['user' => $this->user, 'posts' => $allPosts]);
	}

	public function getJobData()
	{
//		$jobs = Job::select(['jobs.id', 'jobs.title', 'jobs.company_name', 'jobs.created_at', 'jobs.expire']);
		$jobs = Job::select(['jobs.*'])
					->select(DB::raw('( SELECT COUNT(*) FROM applications WHERE applications.job_id = jobs.id ) AS "Applications"'))
					->from('jobs')
					->where('active', '=', 1);

//		$jobs = DB::raw('SELECT jobs.*, ( SELECT COUNT(*) FROM applications WHERE applications.job_id = jobs.id ) AS "Applications" FROM jobs WHERE jobs.active = 1');

		return Datatables::of($jobs)
			->editColumn('created_at', function($data){ return $data->created_at->toFormattedDateString(); })
			->editColumn('expire', function($data){ return $data->expire->toFormattedDateString(); })
			->make(true);
	}

//SELECT  fol.*
//,      (       SELECT  COUNT(*)
//FROM    files           fil
//WHERE   fil.Folder      = fol.Folder
//)       AS      "Files"
//FROM    folders         fol
//WHERE   fol.userId      = 16

	/**
	 * Show the form for creating a new resource.
	 * GET /administrator/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /administrator
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /administrator/{id}
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
	 * GET /administrator/{id}/edit
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
	 * PUT /administrator/{id}
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
	 * DELETE /administrator/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}