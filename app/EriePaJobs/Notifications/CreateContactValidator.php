<?php
/**
 * Created by PhpStorm.
 * User: jackmolnar1982
 * Date: 1/27/15
 * Time: 8:27 PM
 */

namespace EriePaJobs\Notifications;


use EriePaJobs\BaseValidator;

class CreateContactValidator extends BaseValidator{

    /*
     * Contact validation rules
     */
    public static $contact_validation_rules = [
        'name' => 'required',
        'email' => 'required|email',
        'message' => 'required',
    ];

    protected $input;

    function __construct(array $input)
    {
        $this->input = $input;
    }

    public function execute()
    {
        $result = parent::validate($this->input, static::$contact_validation_rules);
        return $result;
    }
}