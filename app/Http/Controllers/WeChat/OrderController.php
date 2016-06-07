<?php
/**
 * Created by PhpStorm.
 * User: roger
 * Date: 2016/6/4
 * Time: 22:59
 */

namespace App\Http\Controllers\WeChat;


use App\Http\Controllers\Controller;
use App\Order;
use App\Place;
use App\Receipt;
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

    public function placeOrder($consult)
    {
        $order = $this->buildOrder($consult);
        Session::put('order',$order->id);
        if($order)
            return view('wechat.flow.place_select');
        return back();
    }

    public function selectAddress(Request $request)
    {
        $address = $request->get('address');
        return view('wechat.flow.place_select',compact('address'));
    }

    public function postSelectAddress(Request $request)
    {
        $order = Order::findOrFail($request->get('order'));
        if(!$order->place){
            Place::create([
                'order_id'  => $order->id,
                'poi_id'    => $request->get('poi'),
                'name'      => $request->get('coffee')
            ]);
        }else{
            $order->place->update([
                'poi_id'    => $request->get('poi'),
                'name'      => $request->get('coffee')
            ]);
        }

        return redirect('wechat/order/confirm/'.$order->id);
    }

    public function confirm($id)
    {
        $order = Order::findOrFail($id);
        return view('wechat.flow.confirm',compact('order'));
    }

    public function postConfirm(Request $request)
    {
        $order_id = $request->get('order');

        $order = Order::findOrFail($order_id);

        if(is_null($order->user->real_name)){
            $order->user->update([
                'real_name' => $request->get('name')
            ]);
        }

        dd($order->receipt);
        if(!$order->receipt){
            Receipt::create([
                'order_id' => $order_id,
                'title'    => $request->get('title'),
                'receiver' => $request->get('receiver'),
                'phone'    => $request->get('phone'),
                'address'  => $request->get('address'),
                'code'     => $request->get('code')
            ]);
        }else{
            $order->receipt->update([
                'title'    => $request->get('title'),
                'receiver' => $request->get('receiver'),
                'phone'    => $request->get('phone'),
                'address'  => $request->get('address'),
                'code'     => $request->get('code')
            ]);
        }

        return redirect('wxpay/js/'.$order->id);
    }
    
}