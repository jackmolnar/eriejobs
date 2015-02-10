<?php

use EriePaJobs\JobSeekers\UpdateSeekerNotificationsCommand;
use Laracasts\TestDummy\Factory as TestDummy;
use EriePaJobs\Notifications\NotificationRepository;

class UpdateSeekerNotificationsCommandTest extends \Codeception\TestCase\Test
{
   /**
    * @var \UnitTester
    */
    protected $tester;
    protected $notificationRepo;

    protected function _before()
    {
        $this->notificationRepo = new NotificationRepository;
    }

    protected function _after()
    {
    }

    // tests
    public function testUpdateSeekerNotificationsCommand()
    {
        $testNotifications = TestDummy::times(3)->create('Notification');

        $input = [
            $testNotifications[0]['id'] => 1,
        ];

        $this->tester->seeRecord('notifications', ['id' => $testNotifications[0]['id']]);

        $updateNotificationsCommand = new UpdateSeekerNotificationsCommand($input);

        $updateNotificationsCommand->execute();

        $this->tester->dontSeeRecord('notifications', ['id' => $testNotifications[0]['id']]);
    }

}