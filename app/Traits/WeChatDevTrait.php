<?php
/**
 * Created by PhpStorm.
 * User: tiandongxiao
 * Date: 27/04/2016
 * Time: 16:24
 */

namespace App\Traits;

use App\User;
use Illuminate\Support\Facades\Log;

trait WeChatDevTrait
{
    use RequestDevTrait;

    public function unionID($open_id, $access_token,$platform = 'PUB')
    {
        switch ($platform){
            case 'OPEN':
                $url = 'https://api.weixin.qq.com/sns/userinfo';      # 微信开放平台
                break;
            case 'PUB':
                $url = 'https://api.weixin.qq.com/cgi-bin/user/info'; # 微信公众平台
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

        if($result && $result->unionid){
            return $result->unionid;
        }

        return null;
    }

    # 如果用户不存在，创建一个用户，并绑定账号
    public function regIfNotExist()
    {
        $account = $this->account();

        if(is_null($account)){
            Log::info('regIfNotExist 获取用户微信account失败');
            return null;
        }

        $user = User::where('union_id', $account->union_id)->first();

        if(!$user){
            Log::info('regIfNotExist 用户不存在，需要创建');
            $user = User::create([
                'avatar'   => $account->avatar,     # 设置头像
                'union_id' => $account->union_id,   # 绑定Union ID
                'open_id'  => $account->open_id,    # 绑定公众号 open_id,不是开放平台 open_id
                'name'     => $account->nickname,   # 昵称
            ]);
        }

        # 检查用户的公众账号open_id是否绑定
        if(!$user->open_id){
            $user->open_id = $account->open_id;
            $user->save();
        }

        return $user;
    }

    # 获取微信公众号账户信息
    public function account()
    {
        $user = session('wechat.oauth_user');

        if ($user) {
            Log::info('account 获取成功');
            if($user['unionid']){
                $union_id = $user['unionid'];
            }else{
                $accessToken = $this->app->access_token;
                $token = $accessToken->getToken(true);  # 强制重新从微信服务器获取 token.
                $union_id = $this->unionID($user->id, $token, 'PUB');
            }
            $account = collect();
            $account->open_id = $user->getId();
            $account->union_id = $union_id;
            $account->avatar = $user['avatar'];
            $account->name = $user['name'];
            $account->nickname = $user['nickname'];
            $account->sex = $user['sex'];

            return $account;
        }
        Log::info('account 获取失败');
        return null;
    }
}