<?php
/**
 * Created by PhpStorm.
 * User: jackmolnar1982
 * Date: 10/26/14
 * Time: 12:56 PM
 */

namespace EriePaJobs\Jobs;

use EriePaJobs\BaseValidator;

class PostNewJobValidator extends BaseValidator {

    public static $post_validation_rules = [
        'title' => 'required|min:5|max:50',
        'description' => 'required',
        'company_name' => 'required',
        'company_city' => 'required',
        'company_state' => 'required',
        'type' => 'required',
        'email' => 'required_without:link|email',
        'link' => 'required_without:email|url'
    ];

    public static $confirm_validation_rules = [
        'confirm' => 'required'
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
    public function execute($flag = '')
    {
        if($flag != '')
        {
            return $result = $this->$flag();
        }
    }

    public function create()
    {
        $result = parent::validate($this->input, static::$post_validation_rules);
        return $result;
    }

    public function confirm()
    {
        $result = parent::validate($this->input, static::$post_validation_rules);
        return $result;
    }
}