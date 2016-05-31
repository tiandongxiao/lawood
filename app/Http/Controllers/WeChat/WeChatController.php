<?php

namespace App\Http\Controllers\WeChat;


use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class WeChatController extends Controller
{
    # 首页
    public function index()
    {
        return view('wechat.index');
    }

    #搜索页
    public function search(Request $request)
    {

        switch ($request->get('chose')){
            case 'position':
                $address  = $request->get('address');
                $major = $request->get('major');
                return view('wechat.search',compact('address','major'));
            case 'name':
                $name = $request->get('name');
                $lawyers = User::where('role','lawyer')->where('real_name',$name)->get();
                if($lawyers->count >= 1)
                    return redirect();
                return redirect(); # 查无此人
        }

    }
}