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

    # 退款
    public function refund($id)
    {
        $order = Order::findOrFail($id);
        if($order->isAllowRefund()){
            $gateway = $order->transactions[0]->gateway;
            switch($gateway){
                case 'wx_native':
                    $result =  redirect('wxpay/refund/'.$order->transactions[0]->transaction_id);
                    dd($result);
                    break;
            }
        }
        $result = $order->refund();
    }
}
