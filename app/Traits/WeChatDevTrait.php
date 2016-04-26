<?php
/**
 * Created by PhpStorm.
 * User: tiandongxiao
 * Date: 26/04/2016
 * Time: 17:15
 */

namespace App\Traits;


use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Artisan;

trait WeChatDevTrait
{
    public function getAccessToken()
    {
        $token = Cache::get('wx_access_token');
        if(is_null($token)){
            $exitCode = Artisan::call('access_token');
            if($exitCode == 0){
                $token = Cache::get('wx_access_token');
            }
        }
        return $token;
    }
}