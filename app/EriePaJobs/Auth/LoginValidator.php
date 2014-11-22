<?php
/**
 * Created by PhpStorm.
 * User: jackmolnar1982
 * Date: 10/22/14
 * Time: 9:39 PM
 */

namespace EriePaJobs\Auth;

use EriePaJobs\BaseValidator;


class LoginValidator extends BaseValidator {

    public static $login_validation_rules = [
        'email' => 'required|exists:users',
        'password' => 'required'
    ];

    protected $input;

    /**
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
        $result = parent::validate($this->input, static::$login_validation_rules);
        return $result;
    }


} 