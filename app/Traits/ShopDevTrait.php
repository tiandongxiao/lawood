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
use App\Order;
use App\Transaction;
use Illuminate\Support\Facades\Auth;

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
        $orders = Auth::user()->orders; # 查询订单($notify->transaction_id);
        foreach($orders as $order){
            $transactions = $order->transations;
            foreach($transactions as $transaction){
                if($transaction->transaction_id == $order_id)
                    return $transaction->order;
            }
        }
        return null;
    }

    # 通过ID来获取交易记录
    public function globalSearchTransaction($id)
    {
        $transaction  = Transaction::where('transaction_id',$id)->first();
        if($transaction)
            return $transaction;
        return null;
    }

    public function queryShopOrder($order_no)
    {
        $order = Order::where('order_no',$order_no)->first();
        if($order)
            return $order;
        return null;
    }

    # 通过Shop Order对象来获取下单顾客信息
    public function client(Order $order)
    {
        return $order->user;
    }

    # 通过Shop Order对象来获取服务卖家
    public function seller(Order $order)
    {
        return Item::find($order->items[0]->reference_id)->user;
    }

    public function getOrders($user)
    {
        $this->getOrdersByStatus($user);
    }

    # 获取待付款的用户订单
    public function getPendingOrders($user)
    {
        return $this->getOrdersByStatus($user,'pending');
    }

    # 获取已完成的用户订单
    public function getCompletedOrders($user)
    {
        return $this->getOrdersByStatus($user,'completed');
    }

    # 获取已付款的用户订单
    public function getPayedOrders($user)
    {
        return $this->getOrdersByStatus($user,'payed');
    }

    # 获取律师已经承接的订单
    public function getAcceptedOrders($user)
    {
        return $this->getOrdersByStatus($user,'accepted');
    }

    # 获取律师已经拒绝的订单
    public function getRejectedOrders($user)
    {
        return $this->getOrdersByStatus($user,'rejected');
    }

    # 获取尚未被律师折现的订单
    public function getNotWithdrawOrders($user)
    {
        $orders = $this->getCompletedOrders($user);
        $filtered = $orders->filter(function($item){
            return $item->withdrew == false;
        });
        return $filtered;
    }

    # 获得已被律师折现的订单
    public function getWithdrewOrders($user)
    {
        $orders = $this->getCompletedOrders($user);
        $filtered = $orders->filter(function($item){
            return $item->withdraw == true;
        });
        return $filtered;
    }

    # 根据用户类型和状态码来获取订单列表
    public function getOrdersByStatus($user, $status)
    {
        switch($user->role){
            case 'lawyer':
                # 定义存储容器
                $orders = [];
                # 获取律师所有服务项
                $items = $user->items;
                # 搜索Item数据库中所有购买了律师服务的条目
                foreach($items as $item){
                    $services = Item::where('reference_id',$item->id)->get();
                    foreach($services as $service){
                        # 每一个条目对应一个Order订单
                        $order = $service->order;
                        if($order->statusCode == $status)
                            $orders[] = $order;
                    }
                }
                return collect($orders);
            case 'client':
                # Shop开发包的这个函数不怎么好用，故而采用下面的方式
                //return Order::findByUser($user->id,$status);
                return Order::whereUser($user->id)
                    ->whereStatus($status)->get();
        }
    }
}