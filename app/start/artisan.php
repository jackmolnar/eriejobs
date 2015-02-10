<?php

/*
|--------------------------------------------------------------------------
| Register The Artisan Commands
|--------------------------------------------------------------------------
|
| Each available Artisan command must be registered with the console so
| that it is available to be called. We'll register every command so
| the console gets access to each of the command object instances.
|
*/

Artisan::add(new DeleteExpiredJobs);
Artisan::add(new RefreshJobsCache);
Artisan::add(new ReindexJobSearch);
Artisan::add(new ReturnJobSearchIndex);
Artisan::add(new RemapJobIndex);
Artisan::add(new SendNewJobNotifications);