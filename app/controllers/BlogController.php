<?php

use EriePaJobs\Blog\BlogRepository;
use EriePaJobs\Blog\StoreNewBlogPostCommand;
use EriePaJobs\Blog\StoreNewBlogPostValidator;
use EriePaJobs\Users\UserRepository;

class BlogController extends \BaseController {

	/**
	 * @var BlogRepository
	 */
	private $blogRepo;
	/**
	 * @var UserRepository
	 */
	private $userRepo;

	function __construct(BlogRepository $blogRepo, UserRepository $userRepo)
	{
		$this->beforeFilter('administrator', ['only' => ['create', 'update', 'destroy']]);

		$this->blogRepo = $blogRepo;
		$this->userRepo = $userRepo;
		View::share('user', $this->userRepo->authedUser());
	}


	/**
	 * Display a listing of the resource.
	 * GET /blog
	 *
	 * @return Response
	 */
	public function index()
	{
		$blogPosts = $this->blogRepo->allPosts();
		return View::make('blog.index', ['posts' => $blogPosts]);
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /blog/create
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('blog.create');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /blog
	 *
	 * @return Response
	 */
	public function store()
	{
		$blogPostValidator = new StoreNewBlogPostValidator(Input::all());
		$valid = $blogPostValidator->execute();

		if($valid['status'])
		{
			$newBlogPostCommand = new StoreNewBlogPostCommand(Input::all());
			$newBlogPostCommand->execute();

			return Redirect::action('ProfilesController@index')->with('success', 'New blog post created.');
		}
		return Redirect::back()->withInput()->withErrors($valid['errors']);

	}

	/**
	 * Display the specified resource.
	 * GET /blog/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$blogPost = $this->blogRepo->getPost($id);
		return View::make('blog.show', ['post' => $blogPost]);
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /blog/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$blogPost = $this->blogRepo->getPost($id);
		return View::make('blog.edit', ['post' => $blogPost] );
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /blog/{id}
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
	 * DELETE /blog/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}