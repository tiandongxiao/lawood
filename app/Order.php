<?php

namespace App;

use Ghanem\Rating\Models\Rating;
use Illuminate\Support\Facades\Auth;
use Amsgames\LaravelShop\Models\ShopOrderModel;

use DraperStudio\Commentable\Contracts\Commentable;
use DraperStudio\Commentable\Traits\Commentable as CommentTrait;


class Order extends ShopOrderModel implements Commentable
{
    use CommentTrait;

    protected $fillable = ['user_id', 'statusCode', 'order_no', 'type', 'subject', 'payed', 'refunded', 'seller_signed', 'client_signed', 'attach','seller_id','sale_id','category'];

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

    # 获取购买的咨询项
    public function getConsultAttribute()
    {
        return $this->items[0];
    }

    # 获取原始卖品信息
    public function getSaleAttribute()
    {
        return Item::findOrFail($this->sale_id);
    }    

    # 获取卖方信息
    public function getSellerAttribute()
    {
        return User::findOrFail($this->seller_id);
    }

    # 获取买方信息
    public function getClientAttribute()
    {
        return $this->consult->user;
    }

    # 接单
    public function accept()
    {
        if($this->statusCode == 'payed' && $this->payed){
            $this->update([
                'statusCode' => 'accepted'
            ]);
            return 'success';
        }
        return 'fail';
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
        return 'fail';
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
        if(Auth::check() && $this->payed && !$this->refunded){
            $role  = Auth::user()->role;
            switch ($this->statusCode){
                case 'accepted':
                    if($role == 'lawyer'){
                        $this->update([
                            'seller_signed' => true,
                            'statusCode' => 'in_process'
                        ]);
                    }
                    if($role == 'client'){
                        $this->update([
                            'client_signed' => true,
                            'statusCode' => 'in_process'
                        ]);
                    }
                    break;
                case 'in_process':
                    if($role == 'lawyer'){
                        $this->update([
                            'seller_signed' => true,
                        ]);
                    }
                    if($role == 'client'){
                        $this->update([
                            'client_signed' => true,
                        ]);
                    }
                    if($this->seller_signed && $this->client_signed)
                        $this->update([
                            'statusCode' => 'completed'
                        ]);
                    break;

            }
            return 'success';
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

    public function getRatingAttribute()
    {
        if($this->rating)
            return Rating::findOrFail($this->rating);
        return null;
    }

    public function getCommentAttribute()
    {
        if($this->comments && $this->comments[0])
            return $this->comments[0];
        return null;
    }

    public function fillSaleInfo(Item $sale)
    {
        $this->update([
            'sale_id'     => $sale->id,
            'seller_id'   => $sale->user->id,
            'category'    => $sale->category->name
        ]);
    }

    public function fillRatingCommentInfo($data)
    {
        $this->update([
            'rating_id'   => $data['rating_id'],
            'comment_id'  => $data['comment_id'],
            ''
        ]);
    }
}
