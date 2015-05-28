<?php
namespace Codeception\Module;

// here you can define custom actions
// all public methods declared in helper class will be available in $I

use Carbon\Carbon;
use EriePaJobs\Auth\LoginUserCommand;
use Laracasts\TestDummy\Factory as TestDummy;

class FunctionalHelper extends \Codeception\Module
{


    function __construct()
    {
        $this->mailcatcher = new \GuzzleHttp\Client(['base_url' => 'http://localhost:1080']);
    }

    /**
     * Get current time
     * @return static
     */
    public function getCurrentTime()
    {
        $now = Carbon::now();
        return $now;
    }

    /**
     * Get expire date
     * @param $created_at
     * @param $timeframe
     * @return static
     */
    public function getExpireDate($created_at, $timeframe)
    {
        $expire_date = new Carbon($created_at);

        return $expire_date->addDays($timeframe);
    }

    /**
     * Create mock account
     * @param string $email
     * @param string $password
     * @param string $role
     * @return $this
     */
    public function haveAnAccount($email = 'mockUser@gmail.com', $password ='frontline', $role = 'Seeker')
    {
        $password = \Hash::make($password);
        $roleId = \Role::where('title', '=', $role)->get(['id'])->first();
        $this->user = TestDummy::create('User', [
            'email' => $email,
            'password' => $password,
            'role_id' => $roleId->id
        ]);

        return $this;
    }

    /**
     * Log in mock user
     * @return $this
     */
    public function logIn($email = 'mockUser@gmail.com', $password = 'frontline')
    {
        $mockInput = [
            'email' => $email,
            'password' => $password
        ];

        $loginUserCommand = new LoginUserCommand($mockInput);

        $result = $loginUserCommand->execute();

        if($result == false)
        {
            $this->fail('User was not logged in.');
        }

        return $this;
    }

    /**
     * Create job listing
     * @param string $email
     * @param null $link
     * @param string $title
     * @return mixed
     */
    public function haveAJobListing($email = 'jackmolnar1982@gmail.com', $link = null, $title = 'Marketing Dude')
    {
        $job = TestDummy::create('Job', [
            'title' => $title,
            'email' => $email,
            'link' => $link
        ]);
        return $job;
    }

}