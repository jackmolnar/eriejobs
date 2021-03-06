<?php

/*
 * Auth Routes
 */
//
Route::get('login', 'AuthController@getLogin');
Route::post('login', 'AuthController@postLogin');
include('routes/SeekerAuthRoutes.php');
include('routes/RecruiterAuthRoutes.php');
Route::controller('password', 'RemindersController');
Route::get('/logout', 'AuthController@logout');
    //restore user accounts
Route::get('/restore-user', 'AuthController@getRestoreUser');
Route::get('/restore-user-confirmed', 'AuthController@restoreUserConfirmed');
Route::get('/send-restore-user', 'AuthController@sendRestoreUser');

/*
 * Jobs Routes
 */
Route::resource('jobs', 'JobsController');
    //create
Route::get('jobs/create/review', 'JobsController@review');
Route::post('jobs/create/payment', 'JobsController@payment');
Route::get('jobs/create/cart', 'JobsController@cart');
Route::get('jobs/create/cart-delete', 'JobsController@deleteCart');
Route::get('jobs/create/thankyou', 'JobsController@thankyou');
    //reader routes
Route::get('jobs/create/reader', 'JobsController@readerCreate');
Route::post('jobs/create/reader', 'JobsController@readerStore');
Route::get('jobs/create/reader/review', 'JobsController@readerReview');
    //destroy
Route::get('jobs/destroy_confirm/{jobs}', 'JobsController@destroy_confirm');
    // trashed
Route::get('jobs/deleted/{jobs}', 'JobsController@showTrashed');
Route::get('jobs/repost/{jobs}', 'JobsController@repost');
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
 * Subscription handling routes
 */
Route::resource('subscription', 'SubscriptionController');
Route::post('subscription/button', 'SubscriptionController@button');

/*
 * Notification routes
 */
Route::post('notifications/create', ['uses' => 'NotificationsController@create', 'as' => 'notifications.create']);

/*
 * SMS Verification Routes
 */
Route::post('send-verification-code', 'NotificationsController@send_sms_verification_code');
Route::post('verify-phone-number', 'NotificationsController@verify_phone_number');
Route::get('delete-phone-number/{id}', 'NotificationsController@delete_phone_number');

/*
 * Profile Routes
 */
Route::resource('profile', 'ProfilesController');
Route::get('edit-info', 'ProfilesController@edit_info');
Route::put('edit-info/{id}', 'ProfilesController@update_info');
Route::get('edit-notifications', 'ProfilesController@edit_notifications');
Route::get('edit-notification-settings', 'ProfilesController@edit_notification_settings');
Route::put('edit-notifications/{id}', 'ProfilesController@update_notifications');
Route::put('edit-notification-settings/{id}', 'ProfilesController@update_notification_settings');
Route::get('destroy-resume', 'ProfilesController@destroy_resume');

/*
 * Pages Routes
 */
Route::get('/', 'PagesController@home');
Route::get('hiring', 'PagesController@hiring');
Route::get('contact', 'PagesController@getContact');
Route::post('contact', 'PagesController@postContact');
Route::get('terms-of-use', 'PagesController@getTermsOfUse');
Route::get('terms-of-guarantee', 'PagesController@getTermsOfGuarantee');
Route::get('reader-dates', 'PagesController@getReaderDates');
Route::resource('blog', 'BlogController');

/*
 * XML Routes
 */
Route::resource('feed', 'FeedController');



//test route
Route::get('test-email', function(){
    $googleAnalytics = new \EriePaJobs\ClientLibraries\GoogleAnalytics(new \EriePaJobs\Jobs\JobsRepository);
    return $googleAnalytics->getViewsBySlug('merchandiser');
});



