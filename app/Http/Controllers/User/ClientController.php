<?php

namespace App\Http\Controllers\User;

use App\Cart;
use App\Item;
use App\Traits\ShopDevTrait;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Shop;

class ClientController extends Controller
{
    use ShopDevTrait;

    private $user;

    public function __construct()
    {
        $this->middleware('auth',['except'=>'board']);
        $this->middleware('role:client',['except'=>'board']);
        $this->user = Auth::user();
    }

    # 总览面板
    public function board()
    {
        return view('client.board');
    }

    public function orders()
    {
        dd($this->user->orders);
    }

    # 返回未付款的订单列表
    public function pendingOrders()
    {
        $orders = $this->getPendingOrders($this->user);
        return view('client.order.pending',compact('orders'));
    }

    # 返回已经完成的订单列表
    public function completedOrders()
    {
        $orders = $this->getCompletedOrders($this->user);
        return view('client.order.completed',compact('orders'));
    }

    # 返回已支付订单列表
    public function payedOrders()
    {
        $orders = $this->getPayedOrders($this->user);
        return view('client.order.payed',compact('orders'));
    }
}
