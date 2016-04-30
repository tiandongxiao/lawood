<?php
/**
 * Created by PhpStorm.
 * User: tiandongxiao
 * Date: 30/04/2016
 * Time: 14:57
 */

namespace App\Self\Notify;


use Illuminate\Support\Facades\Facade;

class NotifyFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'Notify';
    }
}