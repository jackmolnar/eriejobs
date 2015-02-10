<?php 
$I = new FunctionalTester($scenario);

$I->am('A guest');
$I->wantTo('contact the administrator');

$I->resetEmails();

$I->amOnPage('/contact');

$I->fillField('name', 'Jackson Milnap');
$I->fillField('email', 'example@yahoo.com');
$I->fillField('phone', '8148732073');
$I->fillField('message', 'This is the message body.');

$I->click('Send');

$I->seeInLastEmail('Jackson Milnap');
$I->seeInLastEmail('example@yahoo.com');
$I->seeInLastEmail('8148732073');
$I->seeInLastEmail('This is the message body.');


