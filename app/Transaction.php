<?php

namespace App;

use Amsgames\LaravelShop\Models\ShopTransactionModel;

class Transaction extends ShopTransactionModel
{
    protected $fillable = ['order_id', 'gateway', 'transaction_id', 'detail', 'token'];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
