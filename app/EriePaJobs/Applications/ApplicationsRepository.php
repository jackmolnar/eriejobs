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
        $extension = $resume->getClientOriginalExtension();
        $name = $name.'.'.$extension;
        $path = \Config::get('resumes.temp_path');
        $resume->move($path, $name);

        return $path.$name;
    }

    /**
     * Upload permanent resume and return the path
     * @param $resume
     * @return string
     */
    public function uploadPermanentResume($resume)
    {
        $name = $resume->getClientOriginalName();
        $path = \Config::get('resumes.permanent_path');
        $resume->move($path, $name);

        return $path.$name;
    }

    /**
     * Create resume record in resume table
     * @param $user_id
     * @param $path
     */
    public function createResumeRecord($user_id, $path)
    {
        $resume = new \Resume;
        $resume->path = $path;
        $resume->user_id = $user_id;
        $resume->save();
    }

    /**
     * Create application record in application table
     * @param $user_id
     * @param $job_id
     * @return static
     */
    public function createApplicationRecord($user_id, $job_id)
    {
        $application = new \Application;
        return $application->create([
            'user_id' => $user_id,
            'job_id' => $job_id
        ]);
    }
} 