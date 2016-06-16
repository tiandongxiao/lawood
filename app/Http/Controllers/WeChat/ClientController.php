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


    public function notifies()
    {
        $notifies = $this->user->notifications;
        return view('wechat.client.notifies',compact('notifies'));
    }

    public function orders()
    {
        $orders = $this->user->orders->reverse();

        $applies = [];   # 未完成
        $ongoings = [];  # 进行中
        $completes = []; # 已完成

        foreach ($orders as $order){
            switch ($order->statusCode){
                case 'pending': # 下单未付费
                    if($order->place && $order->client->real_name){
                        $applies[] = $order;
                    }else{
                        $order->update([
                            'statusCode' => 'abandoned'
                        ]);
                    }
                    break;
                case 'payed':   # 用户已付费
                case 'rejected': # 律师已拒单
                case 'canceled': # 律师已拒单
                    $applies[] = $order;
                    break;

                case 'accepted': # 律师已接单
                case 'in_process':
                    $ongoings[] = $order;
                    break;

                case 'completed':
                    $completes[] = $order;
                    break;
                case 'failed':
                case 'abandoned':
                    break;
            }
        }

        return view('wechat.client.orders',compact('applies','ongoings','completes'));
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
                $phone = trim($request->get('phone'));
                $this->user->update([
                    'phone' => $phone
                ]);
                return redirect('wechat/client/setting');
            default:
                return redirect('wechat/client/setting');
        }
    }

    public function lawyer($id)
    {
        $lawyer = User::findOrFail($id);
        if($lawyer->role == 'lawyer')
            return view('wechat.client.lawyer',compact('$lawyer'));

        return back();
    }

    public function collection()
    {
        $collects = $this->user->collects;
        return view('wechat.client.collection',compact('collects'));
    }
}