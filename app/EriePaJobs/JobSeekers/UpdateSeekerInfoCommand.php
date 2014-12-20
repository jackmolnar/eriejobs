<?php
/**
 * Created by PhpStorm.
 * User: jackmolnar1982
 * Date: 11/28/14
 * Time: 2:26 PM
 */

namespace EriePaJobs\JobSeekers;


use EriePaJobs\BaseCommand;
use EriePaJobs\Users\UserRepository;

class UpdateSeekerInfoCommand extends BaseCommand
{

    /**
     * @var array $input
     */
    protected  $input;
    /**
     * @var Integer $id
     */
    protected   $id ;

    function __construct(Array $input, $id)
    {
        $this->input = $input;
        $this->id = $id;
    }

    public function execute()
    {
        $userRepo = new UserRepository;
        $user = $userRepo->userById($this->id);

        $user->first_name = $this->input['first_name'];
        $user->last_name = $this->input['last_name'];
        $user->email = $this->input['email'];
        $user->save();

        return $user;

    }
}