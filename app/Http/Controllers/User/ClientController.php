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

    public function buy($item_id)
    {
        return view('payment.chose',compact('item_id'));
    }

    public function routePath()
    {
        if(Auth::check()){
            $user = Auth::user();
            if($user->phone || $user->name){
                return redirect('/')->withErrors('您需要提供您的手机号码和真实姓名，以便律师联系您');
            }
        }
        return redirect('register/client')->withErrors('您需要先注册为咨询客户');
    }

    # 返回未付款的订单列表
    public function pendingOrders()
    {
        $user = Auth::user();
        $user->role = 'client';
        $user->save();

        $orders = $this->getPendingOrders($user);

        return view('client.status.pending',compact('orders'));
    }

    # 返回已经完成的订单列表
    public function completedOrders()
    {
        $user = Auth::user();
        $user->role = 'client';
        $user->save();

        $orders = $this->getCompletedOrders($user);

        return view('client.status.completed',compact('orders'));
    }

    # 返回已支付订单列表
    public function payedOrders()
    {
        $user = Auth::user();
        $user->role = 'client';
        $user->save();

        $orders = $this->getPayedOrders($user);

        return view('client.status.payed',compact('orders'));
    }
}
