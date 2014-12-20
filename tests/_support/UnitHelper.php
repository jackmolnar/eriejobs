<?php
namespace Codeception\Module;

use Hash;
use Laracasts\TestDummy\Factory as TestDummy;
use EriePaJobs\Auth\LoginUserCommand;

// here you can define custom actions
// all public methods declared in helper class will be available in $I

class UnitHelper extends \Codeception\Module
{
    protected $mailcatcher;

    function __construct()
    {
        $this->mailcatcher = new \GuzzleHttp\Client(['base_url' => 'http://localhost:1080']);
    }

    /**
     * Create dummy account
     * @return $this
     */
    public function haveAnAccount()
    {
        $password = Hash::make('mockuser123');
        $this->user = TestDummy::create('User', [
            'email' => 'mockUser@gmail.com',
            'password' => $password
        ]);

        return $this;
    }

    /**
     * Log in dummy user
     * @return $this
     */
    public function logIn()
    {
        $mockInput = [
            'email' => 'mockUser@gmail.com',
            'password' => 'mockuser123'
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
     * Get all current emails
     * @return mixed
     */
    public function getAllEmails()
    {
        $emails = $this->mailcatcher->get('/messages')->json();

        if(empty($emails))
        {
            $this->fail('No emails to return.');
        }

        return $emails;
    }

    /**
     * Get last email
     * @return mixed
     */
    public function getLastEmail()
    {
        $emailId = $this->getAllEmails()[0]['id'];

        return $this->mailcatcher->get('/messages/'.$emailId.'.html');
    }

    /**
     * Get the id of the last email
     */
    public function getLastEmailId()
    {
        return $this->getAllEmails()[0]['id'];
    }

    /**
     * Clear mailcatcher inbox
     */
    public function cleanEmailMessages()
    {
        $this->mailcatcher->delete('/messages');
    }

    /**
     * Assert email body contains expected
     * @param $expected | String
     * @param $email | Json
     */
    public function assertEmailBodyContains($expected, $email)
    {
        $this->assertContains($expected, (string) $email->getBody());
    }

    /**
     * Assert recipient gets the email
     * @param $expected
     * @param string $description
     */
    public function assertEmailRecipientContains($expected, $description = '')
    {
        $emailId = $this->getLastEmailId();
        $response = $this->mailcatcher->get('/messages/'.$emailId.'.json');
        $email = json_decode($response->getBody());
        $this->assertContains('<'.$expected.'>', $email->recipients, $description);
    }

    /**
     * Assert email subject equals expected
     * @param $expected
     * @param string $description
     */
    public function assertEmailSubjectEquals($expected, $description = '')
    {
        $emailId = $this->getLastEmailId();
        $response = $this->mailcatcher->get('/messages/'.$emailId.'.json');
        $email = json_decode($response->getBody());
        $this->assertContains($expected, $email->subject, $description);
    }
}