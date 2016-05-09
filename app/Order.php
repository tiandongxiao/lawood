<?php

namespace App;

use Amsgames\LaravelShop\Models\ShopOrderModel;

class Order extends ShopOrderModel
{
    protected $fillable = ['user_id', 'statusCode', 'order_no', 'refunded', 'withdrew', 'attach'];

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

    # 获取卖家信息
    public function getSellerAttribute()
    {
        return Item::find($this->items[0]->reference_id)->user;
    }
}
