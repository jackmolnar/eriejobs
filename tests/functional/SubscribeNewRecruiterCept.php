<?php 
$I = new FunctionalTester($scenario);

$I->am('a guest');
$I->wantTo('subscribe as a recruiter');

$I->amOnPage('/');
$I->click('Hiring?');
$I->amOnPage('/hiring');
$I->click(['id' => 'recruiter_signup']);
$I->amOnPage('recruiter-signup');

$I->fillField('email', 'testrecruiter@gmail.com');
$I->fillField('first_name', 'Test');
$I->fillField('last_name', 'Recruiter');
$I->fillField('password', 'frontline');
$I->fillField('password_confirmation', 'frontline');
$I->click('Subscribe');

$I->seeRecord('users', [
    'email'         => 'testrecruiter@gmail.com',
    'first_name'    => 'Test',
    'last_name'     => 'Recruiter'
]);


