<?php 
$I = new FunctionalTester($scenario);

$I->resetEmails();

$I->am('a guest');
$I->wantTo('subscribe as a job seeker');

$I->amOnPage('seeker-signup');

$I->fillField('email', 'testseeker@gmail.com');
$I->fillField('first_name', 'Test');
$I->fillField('last_name', 'Seeker');
$I->fillField('password', 'frontline');
$I->fillField('password_confirmation', 'frontline');
$I->click('Subscribe');

$I->seeRecord('users', [
    'email'         => 'testseeker@gmail.com',
    'first_name'    => 'Test',
    'last_name'     => 'Seeker',
    'role_id'       => 2
]);

$I->seeInLastEmail('Welcome to EriePaJobs');


