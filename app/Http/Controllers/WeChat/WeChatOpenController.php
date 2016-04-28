<?php

namespace App\Http\Controllers\WeChat;

use EasyWeChat\Foundation\Application;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use \Socialite;
use Illuminate\Support\Facades\Auth;
use App\User;

class WeChatOpenController extends Controller
{
    /**
     * 微信登陆页面,只有guest用户可访问
     *
     * @return mixed
     */
    public function register()
    {
        return  Socialite::driver('wechat')->redirect();
    }

    /**
     * 微信登陆页面,只有guest用户可访问
     *
     * @return mixed
     */
    public function login()
    {
        return  Socialite::driver('wechat')->redirect();
    }

    /**
     * 用户绑定微信入口，此方法只有auth用户可访问
     *
     * @return mixed
     */
    public function bind()
    {
        return  Socialite::driver('wechat')->redirect();
    }

    /**
     * 解除微信绑定
     *
     * @param Request $request
     */
    public function unBind(Request $request)
    {
        $user = $request->user();
        $user->wx_id = null;
        return back()->withErrors('微信已解除绑定');
    }

    /**
     * 微信登陆回调处理逻辑
     *
     * @return mixed
     */
    public function callback(Request $request)
    {
        $info = Socialite::driver('wechat')->user();

        # 如果用户已登录，则看是否需要为其绑定账号
        if(Auth::check()){
            return $this->bindWxAccountToUser($info);
        }

        # 未登录，则创建新账号或直接登陆
        return $this->createOrLoginWxAccount($info);
    }


    /**
     * 用户账号与微信账号绑定逻辑（）
     *
     * @param $wx_info
     * @return mixed
     */
    private function bindWxAccountToUser($info)
    {
        $user = Auth::user();
        # 用户不是用微信登陆的，那就为其绑定微信号
        if(!$user->wx_id){

            # 数据库中保存用户的Union ID
            $wx_id = $info->original->unionid;

            $result = User::where('wx_id',$wx_id)->first();

            if($result){
                return redirect('/')->withErrors('这个微信账号已被其他用户绑定，您不能绑定此微信账号');
            }

            $user->wx_id = $wx_id;
            $user->save();           

            return redirect('/')->withErrors('完成微信账号绑定');
        }        
        # 用户之前已经用微信扫码登录
        return redirect('/')->withErrors('您已登录，无需重新扫码');
    }

    /**
     * 使用微信用户信息创建一个网站用户账号
     *
     * @param $info
     * @return mixed
     */
    private function createOrLoginWxAccount($info)
    {
        $user = User::where('wx_id',$info['id'])->first();

        # 如果用户是不是已注册用户，需要创建新用户
        if(is_null($user)){
            $user = User::create([
                'wx_id' => $info['id'],
                'role'  => 'none',
            ]);
        }

        Auth::login($user);

        switch ($user->role){
            case 'lawyer':
            case 'assist':
                return redirect('/')->withErrors('欢迎'.$user->role.'使用我们的法律平台');
            case 'client':
                return redirect('/')->withErrors('欢迎咨询用户使用我们的服务');
            case 'none':
                return redirect('bind/chose');
            default:
                return redirect('/')->withErrors('您的信息已被记录，恶意攻击将被记录在案');
        }
    }
}

