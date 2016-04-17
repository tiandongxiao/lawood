<?php

namespace App;

use Amsgames\LaravelShop\Models\ShopTransactionModel;

class Transaction extends ShopTransactionModel
{
    protected $fillable = ['order_id', 'gateway', 'transaction_id', 'detail', 'token'];
}
