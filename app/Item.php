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

    protected $fillable = ['user_id', 'cart_id', 'shop_id', 'sku', 'price', 'tax', 'shipping', 'currency', 'quantity', 'class', 'reference_id','category_id','location_id'];
    
    # 一个咨询服务项只属于一个分类
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    # 一个咨询只拥有一个地址
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

    # 专业度评级系统(只有原始)
    public function major()
    {
        if(!$this->order_id)
            return $this->hasOne(UserMajor::class);
        return null;
    }

    public function getSellerAttribute()
    {
        # 如果是卖方展示的商品项
        if(is_null($this->order_id))
            return User::find($this->user_id);
        
        # 如果是买方订单中的商品项
        return Item::find($this->reference_id)->seller;
    }

    public function getCategoryNameAttribute()
    {
        # 如果是卖方展示的商品项
        if(is_null($this->class))
            return $this->category->name;
        # 如果是买方订单中的商品项
        return Item::find($this->reference_id)->category->name;
    }

    # 获取所有服务项（商品项）
    public static function consults()
    {
        # 卖方商品项仅供展示,不从属于任何订单
        $consults = Item::where('order_id',null)->get();
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

    # 更新POI信息
    public function updatePOI()
    {
        if(!$this->seller->enable)
            return;

        $data = [
            '_name'    => $this->seller->real_name,
            '_address' => $this->location->address,
            'price'    => $this->price,
            'avatar'   => $this->seller->avatar,
            'counter'  => $this->seller->service_count
        ];
        if($this->poi)
            $this->poi->updateInfo($data);
    }

    # 更新价格
    public function updatePrice($price)
    {
        $this->update([
            'price' => $price
        ]);
        $this->updatePOI();
    }

    # 创建consult
    public static function createConsult(array $data)
    {
        $consult = static::create($data);
        $consult->buildPOI();
    }

    # 获取原始展示商品项
    public function getConsultAttribute()
    {
        if($this->reference_id){
            $consult = Item::where('reference_id',$this->reference_id)->first();
            return $consult;
        }
        return null;
    }
}
