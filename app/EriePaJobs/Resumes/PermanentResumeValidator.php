<?php
/**
 * Created by PhpStorm.
 * User: jackmolnar1982
 * Date: 2/21/15
 * Time: 4:58 PM
 */

namespace EriePaJobs\Resumes;
use EriePaJobs\BaseValidator;

class PermanentResumeValidator extends BaseValidator
{

    public static $store_resume_rules = [
        'resume' => 'required|mimes:pdf,doc,docx|max:6000',
    ];

    protected $input;

    function __construct(Array $input)
    {
        $this->input = $input;
    }

    public function execute()
    {
        $result = parent::validate($this->input, static::$store_resume_rules);
        return $result;
    }
}