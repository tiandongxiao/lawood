<?php

namespace App\Http\Controllers\WeChat;

use App\Item;
use EasyWeChat\Foundation\Application;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class WechatController extends Controller
{
    private $app;
    private $user;

    public function __construct(Application $application)
    {
//        $this->app = $application;
        $this->user = Auth::user();

    }
    public function chose()
    {
        return view('wechat.auth.reg_chose');
    }

    public function register($role)
    {
        switch ($role){
            case 'lawyer':
                return view('wechat.auth.reg_lawyer');
            case 'client':
                return view('wechat.auth.reg_client');
        }
    }

    public function postRegister(Request $request)
    {
        $phone = trim($request->get('phone'));
        switch ($request->get('role')){
            case 'client':
                $this->user->phone = $phone;
                $this->user->save();
                return redirect('wechat/consults');
            case 'lawyer':
                $name = trim($request->get('name'));
                $this->user->phone = $phone;
                $this->user->real_name = $name;
                $this->user->save();
                return redirect('wechat/reg_more');
        }
    }

    public function registerMore()
    {
        return view('wechat/auth/reg_lawyer_more');
    }

    public function postRegisterMore(Request $request)
    {

    }

    public function consults()
    {
        $consults = Item::where('class',null)->get();
        return view('wechat.consults',compact('consults'));
    }
}
