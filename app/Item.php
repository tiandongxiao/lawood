<?php

namespace App;

use Amsgames\LaravelShop\Models\ShopItemModel;
use App\Traits\GdYunMapTrait;

class Item extends ShopItemModel
{
    use GdYunMapTrait;

    protected $itemName = 'goods';
    protected $itemRouteParams = ['slug'];

    protected $fillable = ['user_id', 'cart_id', 'shop_id', 'sku', 'price', 'tax', 'shipping', 'currency', 'quantity', 'class', 'reference_id','category_id','location_id','yun_id'];

    /**
     * 一个咨询服务项只属于一个分类
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    /**
     * 一个咨询签到只拥有一个地址
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function location()
    {
        return $this->belongsTo('App\Location');
    }

    public function poi()
    {
        return $this->hasOne('App\Pois');
    }
}
