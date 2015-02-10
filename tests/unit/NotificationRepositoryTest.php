<?php


use EriePaJobs\Notifications\NotificationRepository;
use Laracasts\TestDummy\Factory as TestDummy;


/**
 * @property NotificationRepository notificationRepo
 */
class NotificationRepositoryTest extends \Codeception\TestCase\Test
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
    public function testNotificationById()
    {
        $testNotification = TestDummy::create('Notification', [
            'id' => '1000'
        ]);

        $notification = $this->notificationRepo->notificationById(1000);

        $this->tester->assertEquals($testNotification->id, $notification->id);
    }

    public function testDeleteUserNotifications()
    {
        $user = TestDummy::create('User');

        TestDummy::times(5)->create('Notification', [
            'user_id' => $user->id
        ]);

        $this->tester->assertEquals(5, count($user->jobNotifications));

        $this->notificationRepo->deleteUserNotifications($user->id);

        $this->tester->assertEquals(0, count(Notification::where('user_id', '=', $user->id)->get()), 'Did not delete notifications');
    }

}