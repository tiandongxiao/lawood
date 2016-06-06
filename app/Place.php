<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    public $guarded = ["id","created_at","updated_at"];

    # 一个订单对应一个见面地址
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
