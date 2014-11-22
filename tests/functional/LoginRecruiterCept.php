<?php 
$I = new FunctionalTester($scenario);

$I->am('a guest');
$I->wantTo('log in');

$I->amOnPage('/');
$I->click('Login');

$I->see('Email');

$I->fillField('email', 'jonm@glit.edu');
$I->fillField('password', 'front');

$I->click(['id' => 'login']);

$I->seeAuthentication();


