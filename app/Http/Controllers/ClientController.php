<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Item;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{

    public function chosePayMethod($item_id)
    {
        //$this->routePath();
        //$this->addItemIntoCart($item_id);
        return view('payment.chose',compact('item_id'));
    }

    /**
     * 添加一个商品到购物车
     */
    public function addItemIntoCart($id)
    {
        $consult = Item::find($id);

        if($consult){
            $cart = Cart::current();
            if($cart->hasItem($consult->sku)){
                dd('您未下单的预约咨询中已有此项');
            }
            $cart->add($consult);
        }
    }

    /**
     * 从购物车中删除一个商品项
     */
    public function deleteItemFromCart($id)
    {
        $consult = Item::find($id);
        if($consult){
            $cart = Cart::current();
            if(!$cart->hasItem($consult->sku)){
                dd('您的购物车中没有此项，不能删除');
            }
            $cart->remove($consult);
        }
    }

    /**
     * 下单购物
     */
    public function getPlaceOrder($id)
    {
        $this->addItemIntoCart($id);
        return view('payment/chose');
        # On checkout
        if (!Shop::checkout()) {
            $exception = Shop::exception();
            echo $exception->getMessage(); // echos: error
        }

        # Placing order
        $order = Shop::placeOrder();

        if ($order->hasFailed) {
            $exception = Shop::exception();
            echo $exception->getMessage(); // echos: error
        }
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
}
