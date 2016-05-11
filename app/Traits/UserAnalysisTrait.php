<?php
/**
 * Created by PhpStorm.
 * User: tiandongxiao
 * Date: 11/05/2016
 * Time: 09:30
 */

namespace App\Traits;

use App\UserDressing;
use App\UserPolite;
use App\UserTiming;

trait UserAnalysisTrait
{
    public function dressing()
    {
        return $this->hasOne(UserDressing::class);
    }

    public function timing()
    {
        return $this->hasOne(UserTiming::class);
    }

    public function polite()
    {
        return $this->hasOne(UserPolite::class);
    }
}