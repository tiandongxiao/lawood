<?php

namespace App;

use Amsgames\LaravelShop\Models\ShopOrderModel;

class Order extends ShopOrderModel
{
    protected $fillable = ['user_id', 'statusCode', 'billing_id', 'order_no', 'type', 'subject', 'refunded', 'attach'];

    # 订单是否已退款
    public function isRefunded()
    {
       return $this->refunded;
    }

    # 订单是否允许退款
    public function isAllowRefund()
    {
        if(!$this->isRefunded() && $this->statusCode == 'payed'){
            return true;
        }
        return false;
    }

    # 订单是否已支付
    public function isPayed()
    {
        if($this->statusCode == 'pending')
            return false;
        return true;
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

    public function delete()
    {
        if($this->place)
            $this->place->delete();

        $consults = $this->items;
        foreach($consults as $consult){
            $consult->delete();
        }

        parent::delete();
    }
}
