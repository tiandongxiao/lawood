<?php
/**
 * Created by PhpStorm.
 * User: tiandongxiao
 * Date: 15/05/2016
 * Time: 14:22
 */

namespace App\Http\Controllers\WeChat;


use App\Http\Controllers\Controller;
use App\User;
use EasyWeChat\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    private $app;
    private $user;

    public function __construct(Application $application)
    {
        $this->middleware('auth');
        $this->middleware('role:client');
        $this->app = $application;
        $this->user = Auth::user();
    }

    public function index()
    {
        return view('wechat.client.index');
    }

    public function notifies()
    {
        return view('wechat.client.notifies');
    }

    public function orders()
    {
        return view('wechat.client.orders');
    }

    public function signOrder()
    {
        return view('wechat.client.sign');
    }

    public function setting()
    {
        return view('wechat.client.setting');
    }

    public function config($key)
    {
        switch ($key){
            case 'phone':
                return view('wechat.client.config.phone');
            default:
                return back();
        }
    }

    public function postConfig(Request $request)
    {
        switch ($request->get('key')){
            case 'phone':
                dd('phone');
        }
    }

    public function search()
    {
        return view('wechat.client.results');
    }

    public function postSearch()
    {
        return view('wechat.client.results');
    }

    public function lawyer($id)
    {
        $lawyer = User::findOrFail($id);
        if($lawyer->role == 'lawyer')
            return view('wechat.client.lawyer',compact('$lawyer'));

        return back();

    }
}