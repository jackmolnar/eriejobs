<?php

/*
 * Auth Routes
 */
//
include('routes/SeekerAuthRoutes.php');
include('routes/RecruiterAuthRoutes.php');
Route::controller('password', 'RemindersController');
Route::get('/logout', 'AuthController@logout');

/*
 * Jobs Routes
 */
Route::resource('jobs', 'JobsController');
    //create
Route::get('jobs/create/review', 'JobsController@review');
Route::post('jobs/create/payment', 'JobsController@payment');
Route::get('jobs/create/thankyou', 'JobsController@thankyou');
    //destroy
Route::get('jobs/destroy_confirm/{jobid}', 'JobsController@destroy_confirm');
    //browse
Route::resource('browse', 'BrowseController');
    //search
Route::post('search', 'SearchController@index');
Route::get('search', 'SearchController@index');
    //applications
Route::resource('jobs.application', 'ApplicationsController');
Route::post('store-permanent-application', 'ApplicationsController@storePermanent');
Route::get('jobs/{jobs}/application-sent', array('uses' => 'ApplicationsController@applicationSent', 'as' => 'jobs.applications.sent'));
    //activate - deactivate job
Route::post('jobs/active', ['uses' => 'JobsController@active', 'as' => 'jobs.active']);

/*
 * Notification routes
 */
Route::post('notifications/create', ['uses' => 'NotificationsController@create', 'as' => 'notifications.create']);

/*
 * Profile Routes
 */
Route::resource('profile', 'ProfilesController');
Route::get('edit-info', 'ProfilesController@edit_info');
Route::put('edit-info/{id}', 'ProfilesController@update_info');
Route::get('edit-notifications', 'ProfilesController@edit_notifications');
Route::put('edit-notifications/{id}', 'ProfilesController@update_notifications');
Route::get('destroy-resume', 'ProfilesController@destroy_resume');

/*
 * Pages Routes
 */

Route::get('/', 'PagesController@home');
Route::get('hiring', 'PagesController@hiring');
Route::get('contact', 'PagesController@getContact');
Route::post('contact', 'PagesController@postContact');


//test email route
Route::get('test-email', function(){
    Twilio::message('+18148732073', 'Pink Elephants and Happy Rainbows');
});


