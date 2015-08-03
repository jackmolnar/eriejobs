<?php
/**
 * Created by PhpStorm.
 * User: jackmolnar1982
 * Date: 7/21/15
 * Time: 8:33 PM
 */

namespace EriePaJobs\Jobs;

use EriePaJobs\BaseCommand;
use Session;

class PostNewReaderJobCommand extends BaseCommand {


    function __construct($input)
    {
        $this->jobRepo = new JobsRepository;
        $this->input = $input;
    }

    public function execute()
    {
        $job = new \ReaderJob;
        $job->title             = $this->input['title'];
        $job->description       = $this->input['description'];
        $job->reader_date_id    = $this->input['pubDate'];
//        $job->reader_heading_id = $this->input['heading'];

        $this->jobRepo->storeReaderJob($job);
        return $job;
    }

}