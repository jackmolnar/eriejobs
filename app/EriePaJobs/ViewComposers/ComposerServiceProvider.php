<?php
/**
 * Created by PhpStorm.
 * User: jackmolnar1982
 * Date: 10/25/14
 * Time: 4:10 PM
 */

namespace EriePaJobs\ViewComposers;

use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider {

    public function register()
    {
        $this->app->view->composer('layouts.default', 'EriePaJobs\ViewComposers\MainComposer');
    }
} 