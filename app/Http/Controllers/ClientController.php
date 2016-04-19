<?php

namespace App\Http\Controllers;

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

    /**
     * Native 扫码支付方式（对应于微信第二种扫码支付方式）
     *
     * @param $product_id
     * @return 返回扫码支付界面
     */
    public function nativePay($id)
    {
        # 确保购物车中没有其他商品
        Cart::current()->clear();

        $this->addItemIntoCart($id);

        # 1 执行Shop的其他操作之前，必须先选择支付方式
        Shop::setGateway('wx_native');

        # 2 On checkout 准备结账
        if (!Shop::checkout()) {
            $exception = Shop::exception();
            echo $exception->getMessage();
        }

        # 3 下单
        $order = Shop::placeOrder();

        if ($order->hasFailed) {
            $exception = Shop::exception();
            echo $exception->getMessage();
        }

        $transaction = $order->transactions[0];
        $info = explode('||',$transaction->detail);

        $url = $info[0];
        $price = $info[1];
        return view('payment.wxpay.native',compact('url','price'));
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

    public function pendingOrders()
    {
        $user = Auth::user();
        $user->role = 'client';
        $user->save();

        $orders = $this->getPendingOrders($user);

        return view('client.pending',compact('orders'));
    }

    public function completedOrders()
    {
        $user = Auth::user();
        $user->role = 'client';
        $user->save();

        $orders = $this->getCompletedOrders($user);
        return view('client.completed',compact('orders'));
    }

    public function payedOrders()
    {
        $user = Auth::user();
        $user->role = 'client';
        $user->save();

        $orders = $this->getPayedOrders($user);

        return view('client.payed',compact('orders'));
    }
}
