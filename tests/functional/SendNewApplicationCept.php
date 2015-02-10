<?php 
$I = new FunctionalTester($scenario);

$I->am('A logged in user');
$I->wantTo('send application for a job');

$I->haveAnAccount('example@seeker.com', 'front', 'Seeker');
$I->logIn();

$I->seeAuthentication();

$job = $I->haveAJobListing();

$I->amOnPage('/jobs/'.$job->id);
$I->see($job->title);
$I->click('Apply');

$I->attachFile('resume', 'jon_m_resume.pdf');

$I->click('Submit Application');
