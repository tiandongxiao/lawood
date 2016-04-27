<?php
/**
 * Created by PhpStorm.
 * User: tiandongxiao
 * Date: 27/04/2016
 * Time: 08:57
 */

namespace App\Self\WeChat;

use App\Traits\RequestDevTrait;
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

    const API_GET = 'https://api.weixin.qq.com/cgi-bin/user/info';
    const API_OPEN_PLATFORM_TOKEN = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid=APPID&secret=SECRET&code=CODE&grant_type=authorization_code';

    public function createUrlForOpenPlatformToken()
    {
        $appId = config('services.wechat.client_id');
        $secret = config('services.wechat.client_secret');

        $urlObj = array();
        $urlObj['appid'] = $appId;
        $urlObj['secret'] = $secret;
        $urlObj['code'] = 'code';
        $urlObj['grant_type'] = 'authorization_code';
        $queryStr = http_build_query($urlObj);

        return 'https://open.weixin.qq.com/connect/oauth2/authorize?' . $queryStr;
    }

    public function lala($code)
    {
        $appId = config('services.wechat.client_id');
        $secret = config('services.wechat.client_secret');

        $params = [
            'appid'     =>  $appId,
            'secret'    =>  $secret,
            'code'      =>  $code,
            'grant_type'=>  'authorization_code'
        ];
        $result = $this->makePostRequest(self::API_OPEN_PLATFORM_TOKEN,$params);
        dd($result);

        if($result->status == 1){
            return true;
        }
        return false;
    }
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
        //$access_token = $this->accessToken();
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
    }

    /**
     * 获取微信公众平台的access_token
     *
     * @return string
     */
    public function getOpenPlatformAccessToken()
    {
        $appId = config('services.wechat.client_id');
        $secret = config('services.wechat.client_secret');

        $accessToken = new AccessToken($appId, $secret);

        //$this->createOauthUrlForCode($appId)

        # token 字符串
        $token = $accessToken->getToken();

        return $token;
    }

    public function openPlatform()
    {
        $url = 'https://api.weixin.qq.com/sns/oauth2/access_token';
        
    }

    /**
     * 获取微信公众号授权用户唯一标识
     * @param $app_id 微信公众号应用唯一标识
     * @param $app_secret 微信公众号应用密钥（注意保密）
     * @param $code 授权code, 通过调用WxpubOAuth::createOauthUrlForCode来获取
     * @return openid 微信公众号授权用户唯一标识, 可用于微信网页内支付
     */
    public static function getOpenid($app_id, $app_secret, $code)
    {
        $url = WxpubOAuth::_createOauthUrlForOpenid($app_id, $app_secret, $code);
        $res = self::_getRequest($url);
        $data = json_decode($res, true);

        return $data['openid'];
    }

    /**
     * 用于获取授权code的URL地址，此地址用于用户身份鉴权，获取用户身份信息，同时重定向到$redirect_url
     * @param $app_id 微信公众号应用唯一标识
     * @param $redirect_url 授权后重定向的回调链接地址，重定向后此地址将带有授权code参数，
     *                      该地址的域名需在微信公众号平台上进行设置，
     *                      步骤为：登陆微信公众号平台 => 开发者中心 => 网页授权获取用户基本信息 => 修改
     * @param bool $more_info FALSE 不弹出授权页面,直接跳转,这个只能拿到用户openid
     *                        TRUE 弹出授权页面,这个可以通过 openid 拿到昵称、性别、所在地，
     * @return string 用于获取授权code的URL地址
     */
    public static function createOauthUrlForCode($app_id, $redirect_url, $more_info = false)
    {
        $urlObj = array();
        $urlObj['appid'] = $app_id;
        $urlObj['redirect_uri'] = $redirect_url;
        $urlObj['response_type'] = 'code';
        $urlObj['scope'] = $more_info ? 'snsapi_userinfo' : 'snsapi_base';
        $urlObj['state'] = 'STATE' . '#wechat_redirect';
        $queryStr = http_build_query($urlObj);

        return 'https://open.weixin.qq.com/connect/oauth2/authorize?' . $queryStr;
    }

    /**
     * 获取openid的URL地址
     * @param $app_id 微信公众号应用唯一标识
     * @param $app_secret 微信公众号应用密钥（注意保密）
     * @param $code 授权code, 通过调用WxpubOAuth::createOauthUrlForCode来获取
     * @return string 获取openid的URL地址
     */
    private  function createOauthUrlForOpenid($app_id, $app_secret, $code)
    {
        $urlObj = array();
        $urlObj['appid'] = $app_id;
        $urlObj['secret'] = $app_secret;
        $urlObj['code'] = $code;
        $urlObj['grant_type'] = 'authorization_code';
        $queryStr = http_build_query($urlObj);

        return 'https://api.weixin.qq.com/sns/oauth2/access_token?' . $queryStr;
    }

    /**
     * GET 请求
     */
    private static function _getRequest($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,FALSE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $res = curl_exec($ch);
        curl_close($ch);

        return $res;
    }

    /**
     * 获取微信公众号 jsapi_ticket
     * @param $app_id 微信公众号应用唯一标识
     * @param $app_secret 微信公众号应用密钥（注意保密）
     * @return array 包含 jsapi_ticket 的数组或者错误信息
     */
    public static function getJsapiTicket($app_id, $app_secret) {
        $urlObj = array();
        $urlObj['appid'] = $app_id;
        $urlObj['secret'] = $app_secret;
        $urlObj['grant_type'] = 'client_credential';
        $queryStr = http_build_query($urlObj);
        $accessTokenUrl = 'https://api.weixin.qq.com/cgi-bin/token?' . $queryStr;
        $resp = self::_getRequest($accessTokenUrl);
        $resp = json_decode($resp, true);
        if (!is_array($resp) || isset($resp['errcode'])) {
            return $resp;
        }

        $urlObj = array();
        $urlObj['access_token'] = $resp['access_token'];
        $urlObj['type'] = 'jsapi';
        $queryStr = http_build_query($urlObj);
        $jsapiTicketUrl = 'https://api.weixin.qq.com/cgi-bin/ticket/getticket?' . $queryStr;
        $resp = self::_getRequest($jsapiTicketUrl);

        return json_decode($resp, true);
    }

    /**
     * 生成微信公众号 js sdk signature
     * @param $charge charge
     * @param $jsapi_ticket
     * @param $url    是当前网页的 URL，不包含 # 及其后面部分
     * @return string signature 字符串
     */
    public static function getSignature($charge, $jsapi_ticket, $url = NULL) {
        if (!isset($charge['credential']) || !isset($charge['credential']['wx_pub'])) {
            return null;
        }
        $credential = $charge['credential']['wx_pub'];
        $arrayToSign = array();
        $arrayToSign[] = 'jsapi_ticket=' . $jsapi_ticket;
        $arrayToSign[] = 'noncestr=' . $credential['nonceStr'];
        $arrayToSign[] = 'timestamp=' . $credential['timeStamp'];
        if (!$url) {
            $requestUri = explode('#', $_SERVER['REQUEST_URI']);
            $scheme = isset($_SERVER['REQUEST_SCHEME'])
                ? $_SERVER['REQUEST_SCHEME']
                : (isset($_SERVER['HTTPS'])
                && strtolower($_SERVER['HTTPS']) !== 'off' ? 'https' : 'http');
            $url = $scheme . '://' . $_SERVER['HTTP_HOST'] . $requestUri[0];
        }
        $arrayToSign[] = 'url=' . $url;
        return sha1(implode('&', $arrayToSign));
    }
}