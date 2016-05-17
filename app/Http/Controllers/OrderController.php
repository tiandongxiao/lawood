<?php

namespace App\Http\Controllers;

use App\Item;
use App\Order;
use App\Self\Notify\NotifyFacade;
use App\Traits\ShopDevTrait;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Agent\Facades\Agent;
use Notify;

class OrderController extends Controller
{
    use ShopDevTrait;

    # 对未下单的订单下单
    public function placeOrder($id)
    {
        if(Auth::user())
            dd(Auth::user());
        $consult = Item::findOrFail($id);
        $seller = $consult->seller;
        if($seller->enable == false)
            return back()->withErrors('律师因个人原因暂停服务');

        if (Agent::isMobile()) {
            # 如果是微信浏览器
            if (strpos(Agent::getUserAgent(), 'MicroMessenger') !== false)
                return redirect('wxpay/js/' . $id);
        }
        return redirect('wxpay/native/' . $id);
    }

    # 退款逻辑
    public function refund($id)
    {
        $order = Order::findOrFail($id);
        if($order->isAllowRefund()){
            $gateway = $order->transactions[0]->gateway;
            switch($gateway){
                case 'wx_native':
                case 'wx_js':
                    return  redirect('wxpay/refund/'.$order->order_no);
            }
        }
    }

    public function pendingToAccepted($id)
    {
        $order = Order::findOrFail($id);
        if($order->statusCode == 'pending'){
            $order->statusCode = 'payed';
            $order->save();
        }
        return back();
    }

    # 接单逻辑
    public function accept($id)
    {
        $order = Order::findOrFail($id);
        if($order->statusCode == 'payed'){
            $order->statusCode = 'accepted';
            $order->save();
        }
        return back();
    }

    # 拒单逻辑
    public function reject($id)
    {
        $order = Order::findOrFail($id);
        if($order->statusCode == 'payed'){
            $order->statusCode = 'rejected';
            $order->save();

            # 拒单后立即退款
            $this->refund($id);
            return back()->withErrors('已拒单');
        }
    }

    # 订单签到
    public function sign($id)
    {
        $order = Order::findOrFail($id);

        switch($order->statusCode){
            # 此时双方都为签到
            case 'accepted':
                $order->statusCode = 'in_process';
                break;
            # 此时一方已签到
            case 'in_process':
                $order->statusCode = 'completed';
                break;
        }
        $order->save();
        return back();
    }

    public function cancel($id)
    {
        $order = Order::findOrFail($id);
        if($order->statusCode == 'payed' || $order->statusCode == 'pending'){
            $order->statusCode = 'canceled';
            $order->save();
        }
        return redirect('client/orders');
    }

    public function reminder($id)
    {
        $order = Order::findOrFail($id);
        $seller = $order->seller();        

        Notify::send($seller,['type'=>'reminder','order_id'=>$order->id]);
        return back()->withErrors('已发送催单通知');
    }

    public function heal()
    {
        $orders = Order::where('order_no',null)->get();
        if($orders){
            $orders->each(function($order){
                $order->statusCode = 'abandoned';
            });
        }
    }
}
