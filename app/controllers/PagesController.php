<?php

use EriePaJobs\Blog\BlogRepository;
use EriePaJobs\Notifications\CreateContactValidator;
use EriePaJobs\Notifications\CreateContactCommand;

class PagesController extends \BaseController {

    /**
     * @var BlogRepository
     */
    private $blogRepo;

    function __construct( BlogRepository $blogRepo)
    {
        $this->beforeFilter('loggedin', ['only' => 'home']);
        $this->blogRepo = $blogRepo;
    }

    public function home()
    {
        $blogPosts = $this->blogRepo->recentBlogPosts();
        return View::make('pages.home', ['blogPosts' => $blogPosts]);
    }

    public function hiring()
    {
        return View::make('pages.hiring');
    }

    public function getContact()
    {
        return View::make('pages.contact');
    }
    public function getTermsOfUse()
    {
        return View::make('pages.terms_of_use');
    }
    public function getTermsOfGuarantee()
    {
        return View::make('pages.terms_of_guarantee');
    }

    public function postContact()
    {
        $createContactValidator = new CreateContactValidator(Input::all());
        $valid = $createContactValidator->execute();

        if($valid['status'])
        {
            $createContactCommand = new CreateContactCommand(Input::all());
            $result = $createContactCommand->execute();
            return Redirect::action('PagesController@getContact')->with('success', $result['message']);
        }
        return Redirect::back()->withInput()->withErrors($valid['errors']);
    }


}
