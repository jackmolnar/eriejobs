<?php
/**
 * Created by PhpStorm.
 * User: jackmolnar1982
 * Date: 10/15/14
 * Time: 9:24 PM
 */

Route::get('/', 'PagesController@home');

Route::get('seeker-signup', 'AuthController@getSeekerSignup');

Route::post('seeker-signup', 'AuthController@postSeekerSignup');

Route::get('login', 'AuthController@getSeekerLogin');

Route::post('login', 'AuthController@postSeekerLogin');
