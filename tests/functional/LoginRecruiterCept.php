<?php 
$I = new FunctionalTester($scenario);

$I->am('a guest');
$I->wantTo('log in');

$I->amOnPage('/login');
$I->haveAnAccount('example@example.com', 'fake1234', 'Recruiter');

$I->fillField('email', 'example@example.com');
$I->fillField('password', 'fake1234');

$I->click(['id' => 'login']);

$I->seeAuthentication();

$I->amOnPage('/profile');
