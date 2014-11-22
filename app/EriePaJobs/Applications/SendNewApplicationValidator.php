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
        'resume' => 'required|mimes:pdf,doc,docx|max:6000',
    ];

    protected $input;

    function __construct( Array $input )
    {
        $this->input = $input;
    }

    public function execute()
    {
        $result = parent::validate($this->input, static::$send_application_rules);
        return $result;
    }
} 