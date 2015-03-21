<?php


use EriePaJobs\Notifications\CreateContactCommand;

class CreateContactCommandTest extends \Codeception\TestCase\Test
{
   /**
    * @var \UnitTester
    */
    protected $tester;

    protected function _before()
    {
        $this->tester->cleanEmailMessages();
    }

    protected function _after()
    {
        $this->tester->cleanEmailMessages();
    }

    // tests
    public function testCreateContactCommand()
    {
         $mockInput = [
             'name' => 'Jesse Molgar',
             'email' => 'jesse@gmail.com',
             'phone' => '814-873-2073',
             'message' => 'Hey man I owe $150 because you won in Fantasy Football',
         ];

         $createContactCommand = new CreateContactCommand($mockInput);

         $result = $createContactCommand->execute();

         $this->tester->assertEquals(true, $result['status']);

         $this->tester->assertEmailSubjectEquals('EriePaJobs Website Contact From Jesse Molgar');
    }

}