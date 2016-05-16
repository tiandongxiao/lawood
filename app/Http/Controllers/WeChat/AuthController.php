<?php

namespace App\Http\Controllers\WeChat;

use App\Item;
use App\Location;
use EasyWeChat\Foundation\Application;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    private $app;
    private $user;

    public function __construct(Application $application)
    {
        $this->app = $application;
        $this->middleware('auth');
        $this->user = Auth::user();

    }
    public function chose()
    {
        return view('wechat.auth.reg_chose');
    }

    public function register($role)
    {
        $this->user->role = $role;
        $this->user->save();

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
        switch ($this->user->role){
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
        Log::info('I am reg more');
        return view('wechat.auth.reg_finish');
    }

    public function consults()
    {
        $consults = Item::where('class',null)->get();
        return view('wechat.consults',compact('consults'));
    }

    public function setting($item)
    {
        switch ($item){
            case 'office':
                return view('wechat.lawyer.office');
            case 'home_add':
            case 'work_add':
                $setting = trim($item);
                return view('wechat.lawyer.address',compact('setting'));
        }
    }

    public function postSetting(Request $request)
    {
        $setting = trim($request->get('setting'));
        switch ($setting){
            case 'office':
                $this->user->office = trim($request->get('office'));
                $this->user->save();
                break;
            case 'home_add':
            case 'work_add':
                $address = Location::create([
                    'type'    => $setting,
                    'address' => trim($request->get('address'))
                ]);

                Auth::user()->locations()->save($address);
                break;
        }
        if(!$this->active)
            return redirect('wechat/reg_more');
        return redirect('wechat/settings');
    }

    public function settings()
    {
        return view('wechat.settings');
    }

    public function finish()
    {
        return view('wechat.auth.reg_finish');
    }
}
