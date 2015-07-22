<?php
/**
 * Created by PhpStorm.
 * User: jackmolnar1982
 * Date: 7/21/15
 * Time: 8:33 PM
 */

namespace EriePaJobs\Jobs;


use EriePaJobs\BaseCommand;

class PostNewReaderJobCommand extends BaseCommand {


    function __construct($input)
    {
        $this->input = $input;
    }

    public function execute()
    {
        $job = new Job;
        $job->title             = $this->input['title'];
        $job->description       = $this->input['description'];
        $job->company_name      = $this->input['company_name'];
        $job->company_address   = $this->input['company_address'];
        $job->company_city      = $this->input['company_city'];
        $job->state_id          = $this->input['company_state'];
        $job->salary            = $this->input['salary'] != '' ? $this->input['salary'] : 'Not Set';
        $job->career_level_id   = $this->input['career_level'];
        $job->type_id           = $this->input['type'];
        $job->user_id           = $this->user->id;
        $job->email             = isset($this->input['email']) ? $this->input['email'] : '';
        $job->link              = isset($this->input['link']) ? $this->input['link'] : '';
        $job->expire            = $this->jobsRepo->createExpireDate($this->input['length']);
        $job->confidential      = isset($this->input['confidential']) ? $this->input['confidential'] : false;
        $job->category_id       = $this->input['category'];
        $job->active            = 1;

        Session::put('pending_job.epj_job', $job);

        return $job;
    }

}