<?php
namespace Codeception\Module;

// here you can define custom actions
// all public methods declared in helper class will be available in $I

use Carbon\Carbon;

class FunctionalHelper extends \Codeception\Module
{
    public function getCurrentTime()
    {
        $now = Carbon::now();
        return $now;
    }

    public function getExpireDate($created_at, $timeframe)
    {
        $expire_date = Carbon::createFromTimestamp(strtotime($created_at))->addDays($timeframe);
        return $expire_date;
    }
}