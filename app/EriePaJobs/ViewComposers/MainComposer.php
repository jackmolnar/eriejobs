<?php
/**
 * Created by PhpStorm.
 * User: jackmolnar1982
 * Date: 10/25/14
 * Time: 2:52 PM
 */

namespace EriePaJobs\ViewComposers;

use Auth;


class MainComposer {

    public function compose($view)
    {
        if(Auth::check())
        {
            $user = Auth::user();
        } else {
            $user = false;
        }
        $view->with('user', $user);
    }

} 