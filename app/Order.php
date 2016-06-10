<?php

namespace App;

use Amsgames\LaravelShop\Models\ShopOrderModel;
use EasyWeChat\Foundation\Application;
use Illuminate\Support\Facades\Auth;

class Order extends ShopOrderModel
{
    protected $fillable = ['user_id', 'statusCode', 'order_no', 'type', 'subject', 'payed', 'refunded', 'seller_signed', 'client_signed', 'attach'];

    private $app;
    private $payment;

    # 订单是否已退款
    public function isRefunded()
    {
       return $this->refunded;
    }

    # 订单是否允许退款
    public function isAllowRefund()
    {
        if(!$this->refunded && $this->payed){
            return true;
        }
        return false;
    }

    # 订单是否已支付
    public function isPayed()
    {
        return $this->payed;
    }

    # 每一个订单对应一个地址
    public function place()
    {
        return $this->hasOne(Place::class);
    }

    # 一个订单对应一个或0个报销凭证
    public function receipt()
    {
        return $this->hasOne(Receipt::class);
    }

    # 获取咨询项
    public function getConsultAttribute()
    {
        return $this->items[0];
    }

    # 获取卖方信息
    public function getSellerAttribute()
    {
        return $this->consult->seller;
    }

    # 获取买方信息
    public function getClientAttribute()
    {
        return $this->consult->user;
    }

    # 获取分类信息
    public function getCategoryAttribute()
    {
        return $this->consult->category_name;
    }

    # 接单
    public function accept()
    {
        if($this->statusCode == 'payed' && $this->payed){
            $this->update([
                'statusCode' => 'accepted'
            ]);
        }
    }

    # 拒单
    public function reject()
    {
        if($this->statusCode == 'payed' && $this->payed){
            # 拒单后立即退款
            $result = $this->refund();
            switch ($result){
                case 'repeat':
                case 'success':
                    $this->update([
                        'statusCode' => 'rejected'
                    ]);
                    return 'success';
                default:
                    return $result; # lost/fail
            }
        }
    }

    # 取消订单
    public function cancel()
    {
        if($this->statusCode == 'payed' && $this->payed){
            # 取消订单后立即退款
            $result = $this->refund();
            switch ($result){
                case 'repeat':
                case 'success':
                    $this->update([
                        'statusCode' => 'canceled'
                    ]);
                    return 'success';
                default:
                    return $result; # lost/fail
            }
        }
        if($this->statusCode == 'pending'){
            $this->update([
                'statusCode' => 'canceled'
            ]);
            return 'success';
        }
        return 'fail';
    }

    public function sign()
    {
        if($this->payed && !$this->refunded){
            if($this->statusCode == 'accepted' || $this->statusCode == 'in_process') {
                # 检查当前是否登录状态
                if (Auth::check()) {
                    switch (Auth::user()->role) {
                        case 'lawyer':
                            $this->update([
                                'seller_signed' => true,
                                'statusCode' => 'in_process'
                            ]);
                            break;
                        case 'client':
                            $this->update([
                                'client_signed' => true,
                                'statusCode' => 'in_process'
                            ]);
                            break;
                    }
                    return 'success';
                }
            }
        }
        return 'fail';
    }

    # 退款
    public function refund()
    {
        if(!$this->app || !$this->payment){
            $this->app = app('wechat');
            $this->payment = $this->app->payment;
        }

        if($this->isWxOrderRefunded()){
            return 'repeat';
        }

        # 微信支付的order对象
        $wx_order = $this->queryWxOrder();

        if($wx_order){
            $refund_code = uniqid('REFUND');
            $result = $this->payment->refund($this->order_no,$refund_code, $wx_order->total_fee);

            if($result->return_code == 'SUCCESS' && $result->result_code == 'SUCCESS'){

                $this->update([
                    'refunded' => true
                ]);
                return 'success';
            }
            return 'fail';
        }
        return 'lost'; # 微信订单已丢失
    }

    # 根据微信订单号查询微信订单
    public function queryWxOrder()
    {
        $order = $this->payment->query($this->order_no);
        if($order->return_code == 'SUCCESS' && $order->result_code == 'SUCCESS')
            return $order;
        return null;
    }

    # 判断微信订单是否已经退过款
    public function isWxOrderRefunded()
    {
        $result = $this->payment->queryRefund($this->order_no);
        if($result->return_code == 'SUCCESS' && $result->result_code == 'SUCCESS')
            return true;
        return false;
    }
}
