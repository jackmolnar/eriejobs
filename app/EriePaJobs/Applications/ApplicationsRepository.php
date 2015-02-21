<?php
/**
 * Created by PhpStorm.
 * User: jackmolnar1982
 * Date: 11/3/14
 * Time: 9:49 PM
 */

namespace EriePaJobs\Applications;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class ApplicationsRepository {

    /**
     * Upload Resume and return the path
     * @param UploadedFile $resume
     * @return string
     */
    public function uploadResume($resume)
    {
        $name = strtotime("now");
        $path = \Config::get('resumes.temp_path');
        $resume->move($path, $name);

        return $path.$name;
    }

    /**
     * Upload permanant resume and return the path
     * @param $resume
     * @return string
     */
    public function uploadPermanantResume($resume)
    {
        $name = strtotime("now");
        $path = \Config::get('resumes.permanant_path');
        $resume->move($path, $name);

        return $path.$name;
    }
} 