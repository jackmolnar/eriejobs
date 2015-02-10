<?php 
$I = new FunctionalTester($scenario);

$I->am('Logged in recruiter');
$I->wantTo('Post a new job');

$I->haveAnAccount('example@recruiter.com', 'eriejobs', 'Recruiter');
$I->logIn('example@recruiter.com', 'eriejobs');
$I->seeAuthentication();

$I->amOnPage('/jobs/create');

$I->fillField('title', 'Web Designer');
$I->fillField('description', 'Must know PHP and MySQL.');
$I->fillField('salary', '40000');
$I->selectOption('career_level', 'Experienced');
$I->selectOption('type', 'Full Time');
$I->click(['id' => 'email_contact']);
$I->fillField('email', 'jackmolnar1982@gmail.com');
$I->fillField('link', 'http://www.facebook.com');
$I->selectOption('category', 'Marketing');
$I->fillField('company_name', 'Recon Creative');
$I->fillField('company_address', '1121 West 25th Street');
$I->fillField('company_city', 'Erie');
$I->selectOption('company_state', 'Pennsylvania');
$I->selectOption('length', '30 Days');
$I->click(['id' => 'continue_button']);

$level = $I->grabRecord('career_level', array('level' => 'Experienced'));
$type = $I->grabRecord('types', array('type' => 'Full Time'));
$state = $I->grabRecord('states', array('title' => 'Pennsylvania'));
$category = $I->grabRecord('categories', array('category' => 'Marketing'));
$user = $I->grabRecord('users', array('id' => '11'));
$job = $I->grabRecord('jobs', array('description' => 'Must know PHP and MySQL.'));

$expire_date = $I->getExpireDate($job->created_at, 30);

$I->seeRecord('jobs', [
    'title' => 'Web Designer',
    'description' => 'Must know PHP and MySQL.',
    'salary' => '40000',
    'career_level' => $level->id,
    'type_id' => $type->id,
    'email' => 'jackmolnar1982@gmail.com',
    'link' => 'http://www.facebook.com',
    'company_name' => 'Recon Creative',
    'company_address' => '1121 West 25th Street',
    'company_city' => 'Erie',
    'state_id' => $state->id,
    'user_id' => $user->id,
    'expire' => $expire_date,
]);


$I->seeRecord('category_job', [
    'category_id' => $category->id,
    'job_id' => $job->id
]);

$I->amOnPage('/profile');
$I->see('Job has been posted!');
