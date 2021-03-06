<?php
/**
 * Created by PhpStorm.
 * User: jackmolnar1982
 * Date: 10/17/14
 * Time: 8:44 PM
 */

namespace EriePaJobs\Recruiters;

use EriePaJobs\BaseCommand;

class SubscribeNewRecruiterCommand extends BaseCommand {

    /**
     * @var
     */
    private $input;

    public function __construct($input)
    {
        $this->input = $input;
    }

    public function execute()
    {
        $user = new \User;
        $user->email = $this->input['email'];
        $user->first_name = $this->input['first_name'];
        $user->last_name = $this->input['last_name'];

        $recruiterRole = \Role::where('title', '=', 'Recruiter')->get(['id'])->first();
        $user->role_id = $recruiterRole->id;

        $user->password = \Hash::make($this->input['password']);
        $user->save();

        \Event::fire('auth.recruiter.subscribe', array($user));

        return $user;
    }
}

