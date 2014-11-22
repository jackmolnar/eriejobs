<?php
/**
 * Created by PhpStorm.
 * User: jackmolnar1982
 * Date: 10/22/14
 * Time: 9:42 PM
 */

namespace EriePaJobs\Auth;

use EriePaJobs\BaseCommand;
use Auth;
use Redirect;


class LoginUserCommand extends BaseCommand {

    /**
     * @var
     */
    private $input;

    /**
     * @param $input
     */
    function __construct($input)
    {
        $this->input = $input;
    }

    /**
     * Execute the login
     *
     * @return bool
     */
    public function execute()
    {
        if (Auth::attempt(array('email' => $this->input['email'], 'password' => $this->input['password'])))
        {
            return true;
        } else {
            return false;
        }
    }
}