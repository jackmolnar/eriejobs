<?php
/**
 * Created by PhpStorm.
 * User: jackmolnar1982
 * Date: 10/28/14
 * Time: 10:25 PM
 */

Event::listen('auth.seeker.subscribe', 'EriePaJobs\Events\Auth\NewSeekerSubscribedHandler');
Event::listen('auth.recruiter.subscribe', 'EriePaJobs\Events\Auth\NewRecruiterSubscribedHandler');
Event::listen('auth.login', 'EriePaJobs\Events\Auth\UserLoggedInHandler');
Event::listen('job.create', 'EriePaJobs\Events\Jobs\NewJobPostedHandler');
Event::listen('application.send', 'EriePaJobs\Events\Applications\NewApplicationSentHandler');

Job::observe(new \EriePaJobs\Jobs\JobsObserver);
User::observe(new \EriePaJobs\Users\UserObserver);

