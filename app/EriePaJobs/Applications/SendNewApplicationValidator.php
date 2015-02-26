<?php
/**
 * Created by PhpStorm.
 * User: jackmolnar1982
 * Date: 11/1/14
 * Time: 8:15 PM
 */

namespace EriePaJobs\Applications;

use EriePaJobs\BaseValidator;

class SendNewApplicationValidator extends BaseValidator {

    public static $send_application_rules = [
        'resume' => 'sometimes|required|mimes:pdf,doc,docx|max:6000',
        'resume_radio_group' => 'sometimes|required'
    ];

    public static $messages = array(
        "resume_radio_group.required" => "You must either select to use the resume you have on file or upload a new resume.",
        "resume.required" => "You must browse for a resume to upload."
    );

    protected $input;

    function __construct( Array $input )
    {
        $this->input = $input;
    }

    public function execute()
    {
        $result = parent::validate($this->input, static::$send_application_rules, static::$messages);
        return $result;
    }
} 