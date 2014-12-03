<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

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
Route::get('jobs/destroy_confirm/{jobid}', 'JobsController@destroy_confirm');
    //browse
Route::resource('browse', 'BrowseController');
    //search
Route::post('search', 'SearchController@index');
Route::get('search', 'SearchController@index');
    //applications
Route::resource('jobs.application', 'ApplicationsController');
Route::get('jobs/{jobid}/application/sent', array('uses' => 'ApplicationsController@sent', 'as' => 'jobs.applications.sent'));
    //active
Route::post('jobs/active', ['uses' => 'JobsController@active', 'as' => 'jobs.active']);


/*
 * Profile Routes
 */
Route::resource('profile', 'ProfilesController');
Route::get('edit-info', 'ProfilesController@edit_info');
Route::put('edit-info/{id}', 'ProfilesController@update_info');

/*
 * Pages Routes
 */
Route::get('/', 'PagesController@home');
Route::get('hiring', 'PagesController@hiring');



//Route::get('/testemail', function(){
//    Mail::send('emails.Jobs.NewJobPosted', [], function($message){
//        $message->to('jackmolnar1982@gmail.com')->subject('it worked');
//    });
//});

