<?php 
$I = new FunctionalTester($scenario);

$I->am('a guest');
$I->wantTo('log in');

$I->haveAnAccount('fake@example.com', 'example123', 'Seeker');
$I->amOnPage('/login');

$I->fillField('email', 'fake@example.com');
$I->fillField('password', 'example123');

$I->click(['id' => 'login']);

$I->seeAuthentication();


