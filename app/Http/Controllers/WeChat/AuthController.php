<?php

namespace App\Http\Controllers\WeChat;

use App\Category;
use App\Item;
use App\Location;
use App\Profile;
use App\Traits\CategoryDevTrait;
use App\User;
use EasyWeChat\Foundation\Application;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Bican\Roles\Models\Role;
use App\Http\Requests\PhoneRegRequest;
use App\Http\Requests\ProfileRegRequest;

class AuthController extends Controller
{
    use CategoryDevTrait;

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
        if(in_array($role_name, ['client','lawyer'])) {
            if ($this->user->role == 'none') {
                $this->user->update(['role' => $role_name]);
                $role = Role::where('slug', $role_name)->first();
                if ($role)
                    $this->user->attachRole($role);
            }

            if ($role_name == 'lawyer')
                $this->user->buildLawyer();

            return view('wechat.auth.basic');
        }
        return back();
    }

    public function postBind(Request $request)
    {
        $phone = trim($request->get('phone'));
        $name = trim($request->get('name'));
        if($phone && $name){
            $this->user->update([
                'phone' => $phone,
                'real_name' => $name
            ]);
            switch ($this->user->role){
                case 'client':
                    return redirect('wechat');
                case 'lawyer':
                    return redirect('wechat/profile');
            }
        }
        return back();
    }

    public function profile()
    {
        return view('wechat/auth/profile');
    }

    public function postProfile(Request $request)
    {
        $this->user->office = trim($request->get('office'));
        $this->user->licence = trim($request->get('licence'));
        $this->user->home = trim($request->get('home'));
        $this->user->work = trim($request->get('work'));

        $categories = $request->get('range');
        if ($categories) {
            foreach ($categories as $category) {
                $this->user->bindCategory($category);
            }
        }
        return redirect('wechat/finish');
    }

    public function finish()
    {
        $this->user->buildConsults();
        return view('wechat.auth.finish');
    }
}
