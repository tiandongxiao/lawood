<?php
/**
 * Created by PhpStorm.
 * User: tiandongxiao
 * Date: 15/05/2016
 * Time: 14:22
 */

namespace App\Http\Controllers\WeChat;

use App\Http\Controllers\Controller;
use EasyWeChat\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LawyerController extends Controller
{
    private $app;
    private $user;

    public function __construct(Application $application)
    {
        $this->middleware('auth');
        $this->middleware('role:lawyer');
        $this->app = $application;
        $this->user = Auth::user();
    }

    public function index()
    {
        return view('wechat.lawyer.index');
    }

    public function show($id)
    {
        return view('wechat.lawyer.show',compact('user'));
    }

    public function notifies()
    {
        return view('wechat.lawyer.notifies');
    }

    public function orders()
    {
        return view('wechat.lawyer.orders');
    }

    public function wallet()
    {
        return view('wechat.lawyer.wallet');
    }

    public function draw()
    {
        return view('wechat.lawyer.draw');
    }

    public function postDraw(Request $request)
    {

    }

    public function signOrder()
    {
        return view('wechat.lawyer.sign');
    }

    public function setting()
    {
        return view('wechat.lawyer.setting');
    }

    public function config($key)
    {
        switch ($key){
            case 'phone':
                return view('wechat.lawyer.config.phone');
            case 'office':
                return view('wechat.lawyer.config.office');
            case 'work':
                return view('wechat.lawyer.config.work');
            case 'home':
                return view('wechat.lawyer.config.home');
            case 'major':
                return view('wechat.lawyer.config.major');
            case 'price':
                return view('wechat.lawyer.config.price');
        }
    }

    public function postConfig(Request $request)
    {
        switch ($request->get('key')){
            case 'phone':
                return view('wechat.lawyer.config.office');
            case 'office':
                return view('wechat.lawyer.config.office');
            case 'work':
                return view('wechat.lawyer.config.work_add');
            case 'home':
                return view('wechat.lawyer.config.home_add');
            case 'major':
                return view('wechat.lawyer.config.major');
        }
    }

    public function me()
    {
        $user = $this->user;
        return view('wechat.lawyer.me',compact('user'));
    }
}