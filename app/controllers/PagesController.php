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

    /**
     * Get home page
     * @return \Illuminate\View\View
     */
    public function home()
    {
        $blogPosts = $this->blogRepo->recentBlogPosts();
        return View::make('pages.home', ['blogPosts' => $blogPosts]);
    }

    /**
     * Get hiring page
     * @return \Illuminate\View\View
     */
    public function hiring()
    {
        return View::make('pages.hiring');
    }

    /**
     * Get contact page
     * @return \Illuminate\View\View
     */
    public function getContact()
    {
        return View::make('pages.contact');
    }

    /**
     * Get terms of use page
     * @return \Illuminate\View\View
     */
    public function getTermsOfUse()
    {
        return View::make('pages.terms_of_use');
    }

    /**
     * Get terms of guarantee page
     * @return \Illuminate\View\View
     */
    public function getTermsOfGuarantee()
    {
        return View::make('pages.terms_of_guarantee');
    }

    /**
     * Reader Dates
     * @return \Illuminate\View\View
     */
    public function getReaderDates()
    {
        $readerDates = ReaderDate::futureDates()->get();
        return View::make('pages.reader_dates', ['readerDates' => $readerDates]);
    }

    /**
     * Handle contact form submission
     * @return $this|\Illuminate\Http\RedirectResponse
     */
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
