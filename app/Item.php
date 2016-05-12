<?php

namespace App;

use Amsgames\LaravelShop\Models\ShopItemModel;
use App\Traits\GaodeMapTrait;
use Conner\Likeable\LikeableTrait;
use Ghanem\Rating\Contracts\Ratingable;
use Ghanem\Rating\Traits\Ratingable as RatingTrait;

class Item extends ShopItemModel implements Ratingable
{
    use GaodeMapTrait;    # 引入高德云数据操作
    use LikeableTrait;    # 引入收藏系统
    use RatingTrait;      # 引入评级系统

    protected $fillable = ['user_id', 'cart_id', 'shop_id', 'sku', 'price', 'tax', 'shipping', 'currency', 'quantity', 'class', 'reference_id','category_id','location_id','yun_id'];
    
    # 一个咨询服务项只属于一个分类
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    # 一个咨询签到只拥有一个地址
    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    # 一个咨询项拥有一个POI数据项
    public function poi()
    {
        return $this->hasOne(Pois::class);
    }

    public function delete()
    {
        #删除地图与本地POI信息
        $this->poi->delete();
        parent::delete();
    }

    public function getSellerAttribute()
    {
        # 如果是律师自身items对象中的一个
        if(is_null($this->class)){
            return User::find($this->user_id);
        }
        return Item::find($this->reference_id)->seller;
    }
}
