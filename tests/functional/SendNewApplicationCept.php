<?php 
$I = new FunctionalTester($scenario);

$I->am('A logged in user');
$I->wantTo('send application for a job');

$I->amLoggedAs(['email' => 'jonm@glit.edu', 'password' => 'front']);
$I->seeAuthentication();

$I->amOnPage('/jobs/88');
$I->see('Marketing Manager');
$I->click('Apply');

$I->attachFile('resume', 'jon_m_resume.pdf');

$I->click('Submit Application');
