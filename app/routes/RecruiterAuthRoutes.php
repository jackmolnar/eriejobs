<?php
/**
 * Created by PhpStorm.
 * User: jackmolnar1982
 * Date: 10/15/14
 * Time: 9:24 PM
 */

Route::get('recruiter-signup', 'AuthController@getRecruiterSignup');

Route::post('recruiter-signup', 'AuthController@postRecruiterSignup');