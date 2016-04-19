<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    #查询订单
    public function queryOrder()
    {
        
    }

    public function refund(Order $order)
    {
        if(!$this->isRefunded($order)){
            return back()->withErrors('退款成功');


        }
        return back()->withErrors('订单不可重复退款');
    }

    public function isRefunded(Order $order)
    {

    }


}
