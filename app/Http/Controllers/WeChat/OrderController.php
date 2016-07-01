<?php
/**
 * Created by PhpStorm.
 * User: roger
 * Date: 2016/6/4
 * Time: 22:59
 */

namespace App\Http\Controllers\WeChat;


use App\Http\Controllers\Controller;
use App\Item;
use App\Order;
use App\Place;
use App\Receipt;
use App\Traits\ShopDevTrait;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Shop;
use App\Cart;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    use ShopDevTrait;

    private $user;

    public function __construct()
    {
        $this->middleware('auth',['except'=>'placeOrder']);
        $this->user = Auth::user();
    }

    public function buildOrder($item_id)
    {
        $sale = Item::findOrFail($item_id);

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
        $order->fillSaleInfo($sale);

        Log::info('prePay wx_js placeorder');

        if ($order->hasFailed) {
            $exception = Shop::exception();
            echo $exception->getMessage();
        }


        return $order;
    }

    public function placeOrder($consult)
    {
        if(!Auth::check())
            return view('wechat.flow.lawood');

        if($this->user->role =='none')
            return redirect('wechat/bind/client');

        if($this->user->role != 'lawyer'){
            $order = $this->buildOrder($consult);
            if($order)
                return redirect('wechat/order/address/'.$order->id);
        }

        return back();
    }

    public function selectAddress($order_id)
    {
        $order  = Order::findOrFail($order_id);
        return view('wechat.flow.place_select',compact('order'));
    }

    public function postSelectAddress(Request $request)
    {
        $order = Order::findOrFail($request->get('order'));
        if(!$order->place){
            Place::create([
                'order_id'  => $order->id,
                'poi_id'    => $request->get('poi'),
                'name'      => $request->get('place'),
                'type'      => $request->get('type')
            ]);
        }else{
            $order->place->update([
                'poi_id'    => $request->get('poi'),
                'name'      => $request->get('place'),
                'type'      => $request->get('type')
            ]);
        }

        return redirect('wechat/order/receipt/'.$order->id);
    }

    public function receipt($id)
    {
        $order = Order::findOrFail($id);
        return view('wechat.flow.receipt',compact('order'));
    }

    public function postReceipt(Request $request)
    {
        $order_id = trim($request->get('order'));
        $i_receipt = trim($request->get('switch'));
        $order = Order::findOrFail($order_id);

        if($i_receipt == 'on'){
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
        }
        return redirect('wxpay/js/'.$order->id.'?receipt=y');
    }

    public function confirm($id)
    {
        $order = Order::findOrFail($id);
        return view('wechat.flow.confirm',compact('order'));
    }

    public function accept($id)
    {
        $order = Order::findOrFail($id);
        $order->accept();
        return redirect('wechat/lawyer/orders'.'?tab=in_process');
    }

    public function reject($id)
    {
        $order = Order::findOrFail($id);
        $order->reject();
        Log::info('我拒绝了一个订单');
        return redirect('wechat/lawyer/orders');
    }

    public function cancel($id)
    {
        $order = Order::findOrFail($id);
        $result = $order->cancel();
        return redirect('wechat/client/orders');
    }

    public function sign($id)
    {
        $order = Order::findOrFail($id);
        $order->sign();
        switch ($this->user->role){
            case 'lawyer':
                return redirect('wechat/lawyer/orders'.'?tab='.$order->statusCode);
            case 'client':
                return redirect('wechat/client/orders'.'?tab='.$order->statusCode);
        }
    }

    public function abandon(Request $request,$id)
    {
        $order = Order::findOrFail($id);
        $order->abandon();
        return redirect('wechat/client/orders'.'?tab=applies');

    }

    public function evaluate(Request $request)
    {
        $order = Order::findOrFail(trim($request->get('order')));

        $order->evaluate([
            'client_id'   => trim($request->get('client')),
            'user_score'   => trim($request->get('user-score')),
            'time_score'   => trim($request->get('time-score')),
            'dress_score'  => trim($request->get('dress-score')),
            'polite_score' => trim($request->get('polite-score')),
            'major_score'  => trim($request->get('major-score')),
            'comment' => trim($request->get('comment'))
        ]);

        return back();
    }

    public function evaluateUpdate(Request $request)
    {
        $order = Order::findOrFail(trim($request->get('order')));
        $order->updateEvaluate([
            'client_id'  => trim($request->get('client')),
            'user_score' => trim($request->get('user-score')),
            'comment'    => trim($request->get('comment'))
        ]);

        return back();
    }

    public function showPOI($id)
    {
        return view('wechat.flow.poi',compact('id'));
    }
}