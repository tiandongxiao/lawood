<?php

namespace App;

use Amsgames\LaravelShop\Models\ShopItemModel;
use App\Traits\GdYunMapTrait;

class Item extends ShopItemModel
{
    use GdYunMapTrait; # 引入高德云数据操作

    protected $itemName = 'goods';
    protected $itemRouteParams = ['slug'];

    protected $fillable = ['user_id', 'cart_id', 'shop_id', 'sku', 'price', 'tax', 'shipping', 'currency', 'quantity', 'class', 'reference_id','category_id','location_id','yun_id'];


    # 一个咨询服务项只属于一个分类
    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    # 一个咨询签到只拥有一个地址
    public function location()
    {
        return $this->belongsTo('App\Location');
    }

    # 一个咨询项拥有一个POI数据项
    public function poi()
    {
        return $this->hasOne('App\Pois');
    }
}
