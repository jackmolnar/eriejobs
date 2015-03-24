<?php
/**
 * Created by PhpStorm.
 * User: jackmolnar1982
 * Date: 10/15/14
 * Time: 9:24 PM
 */
Route::get('seeker-signup', 'AuthController@getSeekerSignup');
Route::post('seeker-signup', 'AuthController@postSeekerSignup');

