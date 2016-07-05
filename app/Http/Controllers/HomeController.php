<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use \Socialite;

class HomeController extends Controller
{
    # 主页
    public function index()
    {
        return view('index');
    }

    public function flow()
    {
        return view('site.flow');
    }

    public function editFlow()
    {
        return view('site.flow_edit');
    }

    # about页面
    public function about()
    {
       return view('about');
    }

    # 微信登陆页面,只有guest用户可访问
    public function login()
    {
        return  Socialite::driver('wechat')->redirect();
    }


    #  微信登陆回调处理逻辑
    public function callback(Request $request)
    {
        $account = Socialite::driver('wechat')->user();

        $union_id = $account['original']['unionid'];


        # 如果用户已登录，则看是否需要为其绑定账号
        if(Auth::check()){
            $user = Auth::user();
            if($user->union_id != $union_id){
                Auth::logout();
                return redirect('flow');
            }
        }

        $user = User::where('union_id',$union_id)->where('role','lawyer')->first();
        if($user){
            Auth::login($user);
            return redirect('flow_edit');
        }

        return redirect('flow');
    }
}
