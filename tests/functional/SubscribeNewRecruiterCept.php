<?php 
$I = new FunctionalTester($scenario);

$I->am('a guest');
$I->wantTo('subscribe as a recruiter');

$I->amOnPage('/hiring');

$I->fillField('email', 'testrecruiter@gmail.com');
$I->fillField('first_name', 'Test');
$I->fillField('last_name', 'Recruiter');
$I->fillField('password', 'frontline');
$I->fillField('password_confirmation', 'frontline');
$I->click('Subscribe');

$I->seeRecord('users', [
    'email'         => 'testrecruiter@gmail.com',
    'first_name'    => 'Test',
    'last_name'     => 'Recruiter',
    'role_id'       => 3
]);

$I->seeInLastEmail('Test');
$I->seeInLastEmail('EriePa.Jobs is committed to helping you tap into the talent pool in Northwestern Pennsylvania.');


