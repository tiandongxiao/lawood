<?php

namespace App;

use Amsgames\LaravelShop\Models\ShopOrderModel;

class Order extends ShopOrderModel
{
    protected $fillable = ['user_id', 'statusCode', 'order_no', 'refunded', 'attach'];

    public function isRefunded()
    {
       return $this->refunded;
    }

    public function isAllowRefund()
    {
        if(!$this->isRefunded() && $this->statusCode == 'completed'){
            return true;
        }
        return false;
    }
}
