<?php
/**
 * Created by PhpStorm.
 * User: jackmolnar1982
 * Date: 11/28/14
 * Time: 3:07 PM
 */

namespace EriePaJobs\Events\Auth;

use Auth;
use Carbon\Carbon;

class UserLoggedInHandler {

    public function handle()
    {
        $user = Auth::user();
        $now = Carbon::now();
        $user->last_login = $now;
        $user->save();
    }
} 