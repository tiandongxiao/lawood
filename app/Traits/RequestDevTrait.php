<?php
namespace App\Traits;

/**
 *
 * 使用POST/GET方式请求第三方云服务
 *
 * User: 王国营
 * Date: 2016/4/26
 * Time: 13:48
 *
 */

use GuzzleHttp\Client;

trait RequestDevTrait
{
    private $client; # 进行http请求的客户端实例

    /**
     * POST方式请求第三方云服务
     *
     * @param $uri
     * @param $params
     */
    private function makePostRequest($uri, $params)
    {
        if(!$this->client instanceof Client){
            $this->client = new Client();
        }

        return json_decode($this->client->request('POST',$uri,[
            'form_params'=>$params
        ])->getBody()->getContents());
    }

    /**
     * GET方式请求第三方云服务
     *
     * @param $uri
     * @param $params
     */
    private function makeGetRequest($uri, $params)
    {
        if(!$this->client instanceof Client){
            $this->client = new Client();
        }

        return json_decode($this->client->request('GET',$uri,[
            'query'=>$params
        ])->getBody()->getContents());
    }
}