<?php
/**
 * Created by PhpStorm.
 * User: jackmolnar1982
 * Date: 11/28/14
 * Time: 2:18 PM
 */

namespace EriePaJobs\JobSeekers;

use EriePaJobs\BaseValidator;

class UpdateSeekerInfoValidator extends BaseValidator
{

    protected $input;

    protected static $update_validation_rules = [
        'first_name' => 'required',
        'last_name' => 'required',
        'email' => 'required|email'
    ];

    /**
     * @param array $input
     */
    function __construct(Array $input)
    {
        $this->input = $input;
    }

    /**
     * Execute the validation, return result
     * @return array
     */
    public function execute()
    {
        $result = parent::validate($this->input, static::$update_validation_rules);
        return $result;
    }
}