<?php 
$I = new FunctionalTester($scenario);

$I->am('Logged in recruiter');
$I->wantTo('Post a new job');

$user = $I->haveAnAccount('example@recruiter.com', 'eriejobs', 'Recruiter');
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
$I->selectOption('category', 'Marketing');
$I->fillField('company_name', 'Recon Creative');
$I->fillField('company_address', '1121 West 25th Street');
$I->fillField('company_city', 'Erie');
$I->selectOption('company_state', 'Pennsylvania');
$I->selectOption('length', '30 Days');
$I->click(['id' => 'continue_button']);

$I->amOnPage('/jobs/create/review');

$I->see('Review Your Listing');
$I->see('Web Designer');
$I->see('Must know PHP and MySQL.');
$I->see('40000');
$I->see('Experienced');
$I->see('jackmolnar1982@gmail.com');
$I->see('Recon Creative');
$I->see('1121 West 25th Street');
$I->see('Erie');

$I->click('Post Listing');

$I->amOnPage('/jobs/create/thankyou');
$I->see('Your Job Has Been Listed!');

$level = $I->grabRecord('career_level', array('level' => 'Experienced'));
$type = $I->grabRecord('types', array('type' => 'Full Time'));
$state = $I->grabRecord('states', array('title' => 'Pennsylvania'));
$category = $I->grabRecord('categories', array('category' => 'Marketing'));
$user = $I->grabRecord('users', array('email' => 'example@recruiter.com'));
$job = $I->grabRecord('jobs', array('description' => 'Must know PHP and MySQL.'));

$expire_date = $I->getExpireDate($job->created_at, 30);

$I->seeRecord('jobs', [
    'title' => 'Web Designer',
    'description' => 'Must know PHP and MySQL.',
    'company_name' => 'Recon Creative',
    'company_address' => '1121 West 25th Street',
    'company_city' => 'Erie',
    'state_id' => $state->id,
    'salary' => '40000',
    'career_level_id' => $level->id,
    'type_id' => $type->id,
    'user_id' => $user->id,
    'email' => 'jackmolnar1982@gmail.com',
    'link' => '',
    'active' => 1,
    'expire' => $expire_date,
    'confidential' => 0,
    'slug' => 'web-designer',
    'deleted_at' => null
]);


$I->seeRecord('category_job', [
    'category_id' => $category->id,
    'job_id' => $job->id
]);
