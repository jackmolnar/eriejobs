<?php
/**
 * Created by PhpStorm.
 * User: jackmolnar1982
 * Date: 10/17/14
 * Time: 8:44 PM
 */

namespace EriePaJobs\JobSeekers;

use EriePaJobs\BaseCommand;

class SubscribeNewJobSeekerCommand extends BaseCommand {

    /**
     * @var
     */
    private $input;

    /**
     * Set up command
     *
     * @param $input
     */
    public function __construct($input)
    {
        $this->input = $input;
    }

    /**
     * Execute the Command
     */
    public function execute()
    {
        $user = new \User;
        $user->email        = $this->input['email'];
        $user->first_name   = $this->input['first_name'];
        $user->last_name    = $this->input['last_name'];
        $user->email_notifications = isset($this->input['notifications']) ? $this->input['notifications'] : 0;

        $seekerRole = \Role::where('title', '=', 'Seeker')->first();
        $user->role_id = $seekerRole->id;

        $user->password = \Hash::make($this->input['password']);
        $user->save();

        \Event::fire('auth.seeker.subscribe', array($user));

        return $user;
    }
}

