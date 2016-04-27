<?php
/**
 * Created by PhpStorm.
 * User: tiandongxiao
 * Date: 27/04/2016
 * Time: 08:57
 */

namespace App\Self\WeChat;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Artisan;
use EasyWeChat\Core\AbstractAPI;

class WeChatHelper extends AbstractAPI
{
    const API_GET = 'https://api.weixin.qq.com/cgi-bin/user/info';

    public function getUnionID($open_id, $lang = 'zh_CN')
    {
        $access_token = $this->accessToken();
        $result = $this->get($open_id,$access_token,$lang);
        dd($result);
    }

    /**
     * Fetch a user by open id.
     *
     * @param string $openId
     * @param string $lang
     *
     * @return array
     */
    public function get($openId, $access_token, $lang = 'zh_CN')
    {
        $params = [
            'openid'        => $openId,
            'access_token'  => $access_token,
            'lang'          => $lang,
        ];

        return $this->parseJSON('get', [self::API_GET, $params]);
    }

    /**
     * 获取微信的access_token
     *
     * @return mixed
     */
    public function accessToken()
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