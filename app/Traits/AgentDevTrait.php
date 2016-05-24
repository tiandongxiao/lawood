<?php
/**
 * Created by PhpStorm.
 * User: tiandongxiao
 * Date: 24/05/2016
 * Time: 10:15
 */

namespace App\Traits;

use Jenssegers\Agent\Facades\Agent;

trait AgentDevTrait
{
    # 判断是否是微信浏览器
    public function isWxBrowser()
    {
        if (Agent::isMobile()) {
            if (strpos(Agent::getUserAgent(), 'MicroMessenger') !== false)
                return true;
        }
        return false;
    }
}