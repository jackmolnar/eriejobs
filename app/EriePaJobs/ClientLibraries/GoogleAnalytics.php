<?php
/**
 * Created by PhpStorm.
 * User: jackmolnar1982
 * Date: 6/1/15
 * Time: 9:44 PM
 */

namespace EriePaJobs\ClientLibraries;
use EriePaJobs\Jobs\JobsRepository;

use Google_Client;
use Google_Service_Analytics;
use Google_Auth_AssertionCredentials;

class GoogleAnalytics {

    protected $jobRepo;

    function __construct(JobsRepository $jobRepo)
    {
        $this->profileId = 97457136;
        $this->jobRepo = $jobRepo;
    }

    public function setUp()
    {
        // Creates and returns the Analytics service object.

        // Use the developers console and replace the values with your
        // service account email, and relative location of your key file.
        $service_account_email = '487339418989-59fevb2jgbqkt5kl8nqc481c2r0klelm@developer.gserviceaccount.com';
        $key_file_location = app_path().'/EriePaJobs/ClientLibraries/client_secrets.p12';

        // Create and configure a new client object.
        $client = new Google_Client();
        $client->setApplicationName("HelloAnalytics");
        $analytics = new Google_Service_Analytics($client);

        // Read the generated client_secrets.p12 key.
        $key = file_get_contents($key_file_location);
        $cred = new Google_Auth_AssertionCredentials(
            $service_account_email,
            array(Google_Service_Analytics::ANALYTICS_READONLY),
            $key
        );
        $client->setAssertionCredentials($cred);
        if($client->getAuth()->isAccessTokenExpired()) {
            $client->getAuth()->refreshTokenWithAssertion($cred);
        }

        return $analytics;
    }

    function getViewsBySlug($slug) {

        $analytics = $this->setUp();

        $job = $this->jobRepo->getJobById($slug);

        $params = [ 'filters' => 'ga:pagePath==/jobs/'.$slug ];

        // Calls the Core Reporting API and queries for the number of sessions
        // for the last seven days.
         $result = $analytics->data_ga->get(
            'ga:' . $this->profileId,
            $job->created_at->toDateString(),
            'today',
            'ga:pageviews',
            $params
        );

        return $result->getRows()[0][0];

    }

}