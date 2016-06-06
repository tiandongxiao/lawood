<?php
/**
 * Created by PhpStorm.
 * User: roger
 * Date: 2016/6/4
 * Time: 22:59
 */

namespace App\Http\Controllers\WeChat;


use App\Http\Controllers\Controller;
use App\Traits\ShopDevTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Shop;
use App\Cart;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    use ShopDevTrait;

    public function buildOrder($item_id)
    {
        Cart::current()->clear();
        $this->addItemIntoCart($item_id);

        # 1 执行Shop的其他操作之前，必须先选择支付方式,这里设置为js方式
        Shop::setGateway('wx_js');

        # 2 准备结账
        if (!Shop::checkout()) {
            $exception = Shop::exception();
            echo $exception->getMessage();
        }

        Log::info('prePay wx_js checkout');

        # 3 下单
        $order = Shop::placeOrder();

        Log::info('prePay wx_js placeorder');

        if ($order->hasFailed) {
            $exception = Shop::exception();
            echo $exception->getMessage();
        }

        return $order;
    }

    public function placeOrder(Request $request,$consult)
    {
        return view('wechat.flow.place_select');
//        $address = Session::get('address');
//        $order = $this->buildOrder($consult);
//        Session::put('order',$order->id);
//        if($order)
//
//        return back();
    }

    public function selectAddress(Request $request)
    {
        $address = $request->get('address');
        return view('wechat.flow.place_select',compact('address'));
    }

    public function postSelectAddress(Request $request)
    {
        

    }

    public function pay()
    {
        return view('wechat.flow.pay');
    }
    
}