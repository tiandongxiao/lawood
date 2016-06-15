<?php
namespace App\Http\Controllers\WeChat;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use EasyWeChat\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

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
        $orders = $this->user->seller_orders->reverse();

        $applies = [];   # 未完成
        $ongoings = [];  # 进行中
        $completes = []; # 已完成

        foreach ($orders as $order){
            switch ($order->statusCode){
                case 'payed':
                    $applies[] = $order;
                    break;

                case 'accepted':
                case 'in_process':
                    $ongoings[] = $order;
                    break;

                case 'completed':
                    $completes[] = $order;
                    break;

                default:
                    break;
            }
        }
        return view('wechat.lawyer.orders',compact('applies','ongoings','completes'));
    }

    # 律师钱包管理中心
    public function wallet()
    {
        $incoming = $this->user->incoming;
        $orders = $this->user->getOrdersByStatus('completed');
        return view('wechat.lawyer.wallet',compact('incoming','orders'));
    }

    # 律师提现
    public function draw()
    {
        return view('wechat.lawyer.draw');
    }

    public function postDraw(Request $request)
    {
        $name = trim($request->get('name'));
        $phone = trim($request->get('phone'));
        $card = trim($request->get('card'));
        $code = trim($request->get('code'));
        if(!$name|| !$phone || !$card || !$code)
            return back();
        if($phone != $this->user->phone || $name != $this->user->real_name)
            return back();
        if($code == Cache::get('check_'.$phone)){
            $incoming = $this->user->incoming;
            $result = $this->user->withdraw();
            switch ($result){
                case 'success':
                    $data = [
                        'type'  => 'success',
                        'title' => '提款成功',
                        'body'  => '尊敬的'.$this->user->real_name.'律师，您的提款申请已成功提交，共计'.$incoming.'元，我们将尽快处理，并在月底统一结算',
                        'url'   => url('wechat/lawyer/wallet')
                    ];
                    return view('wechat.info',compact('data'));
                case 'fail':
                    $data = [
                        'type'  => 'fail',
                        'title' => '提款失败',
                        'body'  => '尊敬的'.$this->user->real_name.'律师，您的提款申请提交失败，请稍后再试',
                        'url'   => url('wechat/lawyer/draw')
                    ];
                    return view('wechat.info',compact('data'));
                case 'invalid':
                    $data = [
                        'type'  => 'invalid',
                        'title' => '无效请求',
                        'body'  => '抱歉，您提交的信息有误，不能进行提款',
                        'url'   => url('wechat/lawyer/draw')
                    ];
                    return view('wechat.info',compact('data'));
                default:
                    return null;
            }
        }



        return redirect('wechat/lawyer/wallet');
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
}