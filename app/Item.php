<?php

namespace App;

use Amsgames\LaravelShop\Models\ShopItemModel;
use App\Traits\GaodeMapTrait;
use Conner\Likeable\LikeableTrait;
use Ghanem\Rating\Contracts\Ratingable;
use Ghanem\Rating\Traits\Ratingable as RatingTrait;
use Symfony\Component\Yaml\Tests\A;

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
        if($this->poi)
            $this->poi->delete();
        parent::delete();
    }

    public function getSellerAttribute()
    {
        # 如果是律师自身items对象中的一个
        if(is_null($this->class))
            return User::find($this->user_id);

        return Item::find($this->reference_id)->seller;
    }

    # 获取所有服务项（商品项）
    public static function consults()
    {
        $consults = Item::where('class',null)->get();
        return $consults;
    }

    # 构建POI对象，并推送至地图
    public function buildPOI()
    {
        if(!$this->seller->enable)
            return;

        if(is_null($this->poi)){
            $poi = new Pois();
            $poi->build($this);
            $this->poi()->save($poi);
        }
    }

    # 删除POI对象，并将数据从高德地图中删除
    public function deletePOI()
    {
        if($this->poi){
            $this->poi->delete();
        }
    }

    public function updatePOI()
    {
        if(!$this->seller->enable)
            return;

        $data = [
            '_name'    => $this->category->name,
            '_address' => $this->location->address,
            'price'    => $this->price
        ];
        $this->poi->updateInfo($data);
    }

    public function updatePrice($price)
    {
        $this->update([
            'price' => $price
        ]);
        $this->updatePOI();
    }

    public static function createConsult(array $data)
    {
        $consult = static::create($data);
        $consult->buildPOI();
    }
}
