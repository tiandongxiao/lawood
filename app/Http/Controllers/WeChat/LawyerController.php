<?php
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


    # 律师个人主页
    public function show($id)
    {
        return view('wechat.lawyer.show',compact('user'));
    }

    # 律师通告消息
    public function notifies()
    {
        $notifies = $this->user->notifications;
        $notifies = $notifies->reverse();
        return view('wechat.lawyer.notifies',compact('notifies'));
    }

    # 律师订单中心
    public function orders()
    {
        $orders = $this->user->seller_orders;
        dd($orders);
        return view('wechat.lawyer.orders');
    }

    # 律师钱包管理中心
    public function wallet()
    {
        return view('wechat.lawyer.wallet');
    }

    # 律师提现
    public function draw()
    {
        return view('wechat.lawyer.draw');
    }

    public function postDraw(Request $request)
    {

    }

    # 订单签到
    public function signOrder()
    {
        return view('wechat.lawyer.sign');
    }

    # 设置主界面
    public function setting()
    {
        return view('wechat.lawyer.setting');
    }

    # 具体设置项的界面
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
                # 通过桥接的价格来处理当前的问题，只是权宜之计
                $items = $this->user->prices;
                return view('wechat.lawyer.config.price',compact('items'));
        }
    }

    # 处理设置的逻辑
    public function postConfig(Request $request)
    {
        \Notify::send($this->user,[
            'type'   => 'setting',
            'config' => $request->get('key')
        ]);
        switch ($request->get('key')){
            case 'phone':
                $phone = trim($request->get('phone'));
                $this->user->update([
                    'phone' => $phone
                ]);
                return redirect('wechat/lawyer/setting');

            case 'office':
                $office = trim($request->get('office'));
                $this->user->office = $office;
                return redirect('wechat/lawyer/setting');

            case 'work':
                $work = trim($request->get('work'));
                $this->user->work = $work;
                return redirect('wechat/lawyer/setting');

            case 'home':
                $home = trim($request->get('home'));
                $this->user->home = $home;
                return redirect('wechat/lawyer/setting');

            case 'major':                
                $range = $request->get('range');
                if(!is_null($range)){
                    $this->user->updateCategories($range);
                }
                return redirect('wechat/lawyer/setting');

            case 'price':
                $prices = $request->all();
                foreach ($prices as $key=>$value){
                    if(is_int($key))
                        $this->user->updatePrice($key,$value);
                }
                return redirect('wechat/lawyer/setting');

        }
    }

    # 个人主页
    public function me()
    {
        $user = $this->user;
        return view('wechat.lawyer.me',compact('user'));
    }

}