<?php

namespace App;

use Amsgames\LaravelShop\Models\ShopOrderModel;

class Order extends ShopOrderModel
{
    protected $fillable = ['user_id', 'statusCode','refunded'];

    public function isRefunded()
    {
       return $this->refunded;
    }

    public function isAllowRefund()
    {
        if(!$this->isRefunded() && $this->statusCode == 'pending'){
            return true;
        }
        return false;
    }

    public function refund()
    {
        if($this->isAllowRefund()){
            $gateway = $this->transactions[0]->gateway;
            switch($gateway){
                case 'wx_native':
                    return redirect('/wxpay/refund/'.$this->id);
                    break;
                case 'wx_js':
                    break;
            }
        }
    }
}
