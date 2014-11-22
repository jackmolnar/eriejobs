<?php

class PagesController extends \BaseController {


    public function home()
    {
        return View::make('pages.home');
    }

    public function hiring()
    {
        return View::make('pages.hiring');
    }


}
