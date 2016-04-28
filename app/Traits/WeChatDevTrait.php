<?php
/**
 * Created by PhpStorm.
 * User: tiandongxiao
 * Date: 27/04/2016
 * Time: 16:24
 */

namespace App\Traits;

trait WeChatDevTrait
{
    use RequestDevTrait;

    public function unionID($open_id, $access_token,$platform = 'PUB')
    {
        switch ($platform){
            case 'OPEN':
                $url = 'https://api.weixin.qq.com/sns/userinfo';     # 微信开放平台
                break;
            case 'PUB':
                $url = 'https://api.weixin.qq.com/sns/userinfo'; # 微信公众平台
                break;
            default:
                $url = 'https://api.weixin.qq.com/cgi-bin/user/info'; # 微信公众平台
                break;
        }

        $params = [
            'openid'        => $open_id,
            'access_token'  => $access_token,
        ];

        $result = $this->makeGetRequest($url,$params);
        dd($result);
    }
}