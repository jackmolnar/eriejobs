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
Route::resource('browse', 'BrowseController');
Route::resource('search', 'SearchController');
Route::post('search/result', 'SearchController@result');
Route::resource('jobs.application', 'ApplicationsController');
Route::get('jobs/{jobid}/application/sent', array('uses' => 'ApplicationsController@sent', 'as' => 'jobs.applications.sent'));


/*
 * Profile Routes
 */
Route::resource('profile', 'ProfilesController');

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

