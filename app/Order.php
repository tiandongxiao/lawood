<?php

namespace App;

use Ghanem\Rating\Models\Rating;
use Illuminate\Support\Facades\Auth;
use Amsgames\LaravelShop\Models\ShopOrderModel;
use DraperStudio\Commentable\Models\Comment;


class Order extends ShopOrderModel
{
    protected $fillable = ['user_id', 'statusCode', 'order_no', 'type', 'subject', 'payed', 'refunded', 'seller_signed', 'client_signed', 'attach','seller_id','sale_id','category','rating_id','comment_id','withdrew','allow_draw','allow_cancel','bill_id'];

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
        return $this->user;
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
        if($this->rating_id)
            return Rating::findOrFail($this->rating_id);
        return null;
    }

    public function getCommentAttribute()
    {
        if($this->comment_id)
            return Comment::findOrFail($this->comment_id);
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

    public function fillEvaluateInfo($data)
    {
        $this->update([
            'rating_id'   => $data['rating_id'],
            'comment_id'  => $data['comment_id']
        ]);
    }

    public function evaluate($data)
    {
        if($this->rating_id || $this->comment_id)
            return;

        if($this->user_id == $data['client_id']) {
            $client = $this->client;

            # 给卖方人评级打分
            $seller = $this->seller;
            $rating = $seller->rating([
                'rating' => $data['user_score']
            ], $client);

            $comment = $seller->comment([
                'body' => $data['comment']
            ], $client);

            $this->fillEvaluateInfo([
                'rating_id' => $rating->id,
                'comment_id' => $comment->id
            ]);

            $seller->timing->rating([
                'rating' => $data['time_score']
            ], $client);

            $seller->dressing->rating([
                'rating' => $data['dress_score']
            ], $client);

            $seller->polite->rating([
                'rating' => $data['polite_score']
            ], $client);

            $this->sale->rating([
                'rating' => $data['major_score']
            ], $client);
        }
    }

    public function updateEvaluate($data)
    {
        if($this->rating_id && $this->comment_id){
            if($this->user_id == $data['client_id']) {

                $this->rating->update([
                    'rating' => $data['user_score']
                ]);
                $this->comment->update([
                    'body' => $data['comment']
                ]);
            }
        }
    }

    public function bill()
    {
        return $this->belongsTo(Bill::class);
    }
}
