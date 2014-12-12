<?php


use EriePaJobs\Applications\ApplicationsRepository;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ApplicationsRepositoryTest extends \Codeception\TestCase\Test
{
   /**
    * @var \UnitTester
    */
    protected $tester;

    // tests
    public function testUploadResume()
    {
        $file = new UploadedFile(
            app_path().'/EriePaJobs/Applications/Resumes/test.pdf',
            "test.pdf",
            'pdf'
        );

        $AppRepo = new ApplicationsRepository;

        $uploadedFilePathAndName = $AppRepo->uploadResume($file);

        $array = explode('/', $uploadedFilePathAndName);
        $filename = end($array);
        $filepath = str_replace($filename, '', $uploadedFilePathAndName);

        $this->tester->seeFileFound($filename, $filepath);
    }

}