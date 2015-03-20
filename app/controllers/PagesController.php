<?php

use EriePaJobs\Notifications\CreateContactValidator;
use EriePaJobs\Notifications\CreateContactCommand;

class PagesController extends \BaseController {


    function __construct()
    {
        $this->beforeFilter('loggedin', ['only' => 'home']);
    }

    public function home()
    {
        return View::make('pages.home');
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
