<?php 
$I = new FunctionalTester($scenario);

$I->resetEmails();

$I->am('Logged in job seeker');
$I->wantTo('Send an application');

$I->haveAnAccount('fake@example.com', 'example123', 'Seeker');
$I->logIn('fake@example.com', 'example123');
$I->seeAuthentication();

$job = $I->haveAJobListing();

$I->amOnPage('/jobs/'.$job->id.'/application/create');
$I->see('Apply to the '.$job->title.' Position');

$I->fillField('cover_letter', 'This is my cover letter.');
$I->attachFile('resume', 'jon_m_resume.pdf');

$I->click('Submit Application');

$I->see('Your Application for '.$job->title.' Has Been Sent!');

$I->seeInLastEmailTo('fake@example.com', 'Your Application Has Been Sent!');
$I->seeInLastEmailTo('jackmolnar1982@gmail.com', 'New Application From EriePaJobs');

