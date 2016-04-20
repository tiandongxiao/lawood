<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    # 查询订单
    public function queryOrder()
    {
        
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

    # 接单逻辑
    public function accept($id)
    {
        $order = Order::findOrFail($id);
        if($order->statusCode == 'payed'){
            $order->statusCode = 'accepted';
        }
    }

    # 拒单逻辑
    public function reject($id)
    {
        $order = Order::findOrFail($id);
        if($order->statusCode == 'payed'){
            $order->statusCode = 'rejected';
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
    }
}
