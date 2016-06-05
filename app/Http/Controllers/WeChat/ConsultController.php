<?php
/**
 * Created by PhpStorm.
 * User: tiandongxiao
 * Date: 16/05/2016
 * Time: 17:18
 */

namespace App\Http\Controllers\WeChat;


use App\Http\Controllers\Controller;
use App\Item;
use App\Traits\AgentDevTrait;
use App\Traits\ShopDevTrait;
use Illuminate\Support\Facades\Auth;

use Shop;
use App\Cart;
use Illuminate\Support\Facades\Log;

class ConsultController extends Controller
{
    use AgentDevTrait;
    use ShopDevTrait;

    public function __construct()
    {
        
    }

    public function index()
    {
        $consults = Item::consults();
        return view('wechat.consults',compact('consults'));
    }


    public function buildOrder($id)
    {
        Cart::current()->clear();
        $this->addItemIntoCart($id);

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

    public function buy($consult_id)
    {
        $order = $this->buildOrder($consult_id);
    }

    public function selectPlace()
    {
        return view('wechat.flow.place_select');
    }

    public function postSelectPlace()
    {
        return view();
    }
}