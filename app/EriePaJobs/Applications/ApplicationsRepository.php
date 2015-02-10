<?php
/**
 * Created by PhpStorm.
 * User: jackmolnar1982
 * Date: 11/3/14
 * Time: 9:49 PM
 */

namespace EriePaJobs\Applications;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Queue;

class ApplicationsRepository {

    /**
     * Upload Resume and return the path
     * @param UploadedFile $resume
     * @return string
     */
    public function uploadResume( $resume)
    {
        $name = strtotime("now").'_'.$resume->getClientOriginalName();
        $path = app_path().'/EriePaJobs/Applications/Resumes/';
        $resume->move($path, $name);

//        Queue::push(function($job) use ($name, $path, $resume)
//        {
//            $resume->move($path, $name);
//            $job->delete();
//        });

        return $path.$name;
    }
} 