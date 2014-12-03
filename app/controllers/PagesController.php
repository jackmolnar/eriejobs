<?php

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


}
