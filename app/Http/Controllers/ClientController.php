<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Item;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ClientController extends Controller
{
    public function addItemIntoCart($id)
    {
        $consult = Item::find($id);

        if($consult){
            $cart = Cart::current();
            if($cart->hasItem($consult->sku)){
                dd('您未下单的预约咨询中已有此项');
            }
            $cart->add($consult);
            dd($cart);
        }
    }

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

    public function getPlaceOrder($id)
    {
        $this->addItemIntoCart($id);
        $cart = Cart::current();
        $order = $cart->placeOrder();
        dd($order);
    }
}
