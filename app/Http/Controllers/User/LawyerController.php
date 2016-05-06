<?php

namespace App\Http\Controllers\User;

use App\Traits\CategoryDevTrait;
use App\Traits\ConsultDevTrait;
use App\Traits\LocationDevTrait;
use App\Traits\ShopDevTrait;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class LawyerController extends Controller
{
    use ShopDevTrait;       # 电子商务开发包
    use ConsultDevTrait;    # 电商开发辅助包
    use LocationDevTrait;   # 地址开发辅助包
    use CategoryDevTrait;   # 业务门类开发包

    private $user;

    public function __construct()
    {
        $this->middleware('auth',['except'=>'board']);
        //$this->middleware('role:lawyer',['except'=>'board']);
        $this->user = Auth::user();
    }

    # 总览面板
    public function board()
    {
        return view('lawyer.board');
    }

    public function orders()
    {        
        $orders = $this->getPendingOrders($this->user);
        dd($orders);
    }

    # 已完成的订单
    public function completedOrders()
    {
        $orders = $this->getCompletedOrders($this->user);
        return view('lawyer.order.completed',compact('orders'));
    }

    # 已付款，尚未承接的订单
    public function payedOrders()
    {
        $orders = $this->getPayedOrders($this->user);
        return view('lawyer.order.payed',compact('orders'));
    }

    # 已经承接的订单
    public function acceptedOrders()
    {
        $orders = $this->getAcceptedOrders($this->user);
        return view('lawyer.order.accepted',compact('orders'));
    }

    # 拒绝的订单
    public function rejectedOrders()
    {
        $orders = $this->getRejectedOrders($this->user);
        return view('lawyer.order.rejected',compact('orders'));
    }

    # 提款
    public function withdraw()
    {
        $sum = $this->account();
        dd($sum);
    }

    public function account()
    {
        $orders = $this->getPayedOrders($this->user);
        $sum = 0;

        foreach($orders as $order){
            $sum += $order->total;
        }
        return $sum/100;
    }

    public function notifies()
    {
        $notifies = $this->user->notifications;

        return view('lawyer.notify.index',compact('notifies'));
    }

    public function readNotifies()
    {

    }

    public function unreadNotifies()
    {

    }
}
