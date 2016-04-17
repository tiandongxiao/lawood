<?php
/**
 * Created by PhpStorm.
 * User: tiandongxiao
 * Date: 17/04/2016
 * Time: 16:43
 */

namespace App\Traits;

use App\Item;
use App\Cart;

trait ShopDevTrait
{
    # 添加一个商品到购物车
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

    # 从购物车中删除一个商品项
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

    public function closeOrders()
    {
        $orders = Auth::user()->orders();
        foreach($orders as $order){
            $order->close();
        }
    }

    public function searchTransaction($order_id)
    {
        $orders = Auth::user()->orders; #查询订单($notify->transaction_id);
        foreach($orders as $order){
            $transactions = $order->transations;
            foreach($transactions as $transaction){
                if($transaction->transaction_id == $order_id)
                    return $transaction;
            }
        }
        return null;
    }

    public function searchOrderById($order_id)
    {
        $orders = Auth::user()->orders; #查询订单($notify->transaction_id);
        foreach($orders as $order){
            $transactions = $order->transations;
            foreach($transactions as $transaction){
                if($transaction->transaction_id == $order_id)
                    return $transaction->order;
            }
        }
        return null;
    }
}