<?php

namespace App;

use Amsgames\LaravelShop\Models\ShopTransactionModel;

class Transaction extends ShopTransactionModel
{
    protected $fillable = ['order_id', 'gateway', 'transaction_id', 'detail', 'token'];

    # 包里的定义有问题，所以自定义了新的关联
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
