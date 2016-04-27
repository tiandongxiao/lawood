<?php
/**
 * Created by PhpStorm.
 * User: tiandongxiao
 * Date: 27/04/2016
 * Time: 08:57
 */

namespace App\Self\WeChat;

use App\Traits\RequestDevTrait;
use Carbon\Carbon;
use EasyWeChat\Core\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Artisan;
use EasyWeChat\Core\Exceptions\HttpException;
use EasyWeChat\Support\Collection;

use GuzzleHttp\Psr7\Uri;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use EasyWeChat\Core\AccessToken;


class WeChatHelper
{
    use RequestDevTrait;
    /**
     * Http instance.
     *
     * @var \EasyWeChat\Core\Http
     */
    protected $http;

    /**
     * The request token.
     *
     * @var \EasyWeChat\Core\AccessToken
     */
    protected $accessToken;

    const GET = 'get';
    const POST = 'post';
    const JSON = 'json';

    # 微信开放平台获取UnionID
    const API_OAUTH_GET = 'https://api.weixin.qq.com/sns/userinfo';
    # 微信公众平台获取UnionID
    const API_GET = 'https://api.weixin.qq.com/cgi-bin/user/info';

    /**
     * Return the http instance.
     *
     * @return \EasyWeChat\Core\Http
     */
    public function getHttp()
    {
        if (is_null($this->http)) {
            $this->http = new Http();
        }

        return $this->http;
    }

    /**
     * Set the http instance.
     *
     * @param \EasyWeChat\Core\Http $http
     *
     * @return $this
     */
    public function setHttp(Http $http)
    {
        $this->http = $http;

        return $this;
    }

    /**
     * Parse JSON from response and check error.
     *
     * @param string $method
     * @param array  $args
     *
     * @return \EasyWeChat\Support\Collection
     */
    public function parseJSON($method, array $args)
    {
        $http = $this->getHttp();

        $contents = $http->parseJSON(call_user_func_array([$http, $method], $args));

        $this->checkAndThrow($contents);

        return new Collection($contents);
    }

    /**
     * Check the array data errors, and Throw exception when the contents contains error.
     *
     * @param array $contents
     *
     * @throws \EasyWeChat\Core\Exceptions\HttpException
     */
    protected function checkAndThrow(array $contents)
    {
        if (isset($contents['errcode']) && 0 !== $contents['errcode']) {
            if (empty($contents['errmsg'])) {
                $contents['errmsg'] = 'Unknown';
            }

            throw new HttpException($contents['errmsg'], $contents['errcode']);
        }
    }


    /**
     * @param $open_id
     * @param string $lang
     */
    public function getUnionID($open_id, $access_token, $lang = 'zh_CN')
    {
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
        ];

        return $this->parseJSON('get', [self::API_GET, $params]);
    }

    /**
     * 获取微信公众账号的access_token
     *
     * @return string
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
        // o0VwFwtZgDSVGHFUQHqNggut0bZc
    }
}