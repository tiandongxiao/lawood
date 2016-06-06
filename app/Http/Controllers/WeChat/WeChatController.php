<?php

namespace App\Http\Controllers\WeChat;


use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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
                Session::put('address',$address);
                $major = $request->get('major');
                $tab = $request->get('tab');
                return view('wechat.search',compact('address','major','tab'));
            case 'name':
                $name = $request->get('name');
                $lawyers = User::where('role','lawyer')->where('real_name',$name)->get();
                return view('wechat.search_lawyer',compact('lawyers'));
        }
    }

    public function showUser($id)
    {
        $user = User::findOrFail($id);
        if($user->role == 'lawyer')
            return view('wechat.lawyer.index',compact('user'));
        abort(404);
    }

    public function qrCode()
    {
        return view('wechat.qrcode');
    }
}