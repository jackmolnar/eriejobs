<?php
/**
 * Created by PhpStorm.
 * User: jackmolnar1982
 * Date: 10/17/14
 * Time: 9:06 PM
 */

namespace EriePaJobs\JobSeekers;

use EriePaJobs\BaseValidator;

class SubscribeNewJobSeekerValidator extends BaseValidator {

    public static $subscribe_validation_rules = [
        'email' => 'required|email|unique:users',
        'first_name' => 'required',
        'last_name' => 'required',
        'password' => 'required|confirmed'

    ];

    protected $input;

    /**
     * Set up validator
     *
     * @param array $input
     */
    function __construct(array $input)
    {
        $this->input = $input;
    }

    /**
     * Execute the validation
     *
     * @return array
     */
    public function execute()
    {
        $result = parent::validate($this->input, static::$subscribe_validation_rules);
        return $result;
    }


}