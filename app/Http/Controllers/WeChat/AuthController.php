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
        return view('wechat.auth.chose');
    }

    public function bind($role_name)
    {
        if($this->user->role == 'none') {
            $this->user->role = $role_name;
            $this->user->save();
            $role = Role::where('slug',$role_name)->first();
            if($role)
                $this->user->attachRole($role);
        }

        switch ($role_name){
            case 'lawyer':
                if(!$this->user->phone)
                    return view('wechat.auth.lawyer');
                if(!$this->user->office)
                    return redirect('wechat/profile');
                return redirect('wechat/lawyer');
            case 'client':
                if(!$this->user->phone)
                    return view('wechat.auth.client');
                return redirect('wechat/client');
            default:
                break;
        }
    }

    public function postBind(Request $request)
    {
        $phone = trim($request->get('phone'));
        switch ($this->user->role){
            case 'client':
                $this->user->phone = $phone;
                $this->user->save();
                return redirect('wechat/client');
            case 'lawyer':
                $name = trim($request->get('name'));
                $this->user->phone = $phone;
                $this->user->real_name = $name;
                $this->user->save();
                return redirect('wechat/profile');
        }
    }

    public function profile()
    {
        return view('wechat/auth/profile');
    }

    public function postProfile(Request $request)
    {
        Log::info('I am reg more');
        return view('wechat.auth.finish');
    }

    public function consults()
    {
        $consults = Item::where('class',null)->get();
        return view('wechat.consults',compact('consults'));
    }
}
