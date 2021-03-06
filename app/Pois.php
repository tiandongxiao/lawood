<?php
namespace App;

use App\Traits\GaodeMapTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class Pois extends Model
{
    use GaodeMapTrait;

    public $guarded = ["id","created_at","updated_at"];


    public static function findRequested()
    {
        $query = Pois::query();

        // search results based on user input
        \Request::input('id') and $query->where('id',\Request::input('id'));
        \Request::input('poi_id') and $query->where('poi_id',\Request::input('poi_id'));
        \Request::input('created_at') and $query->where('created_at',\Request::input('created_at'));
        \Request::input('updated_at') and $query->where('updated_at',\Request::input('updated_at'));
        
        // sort results
        \Request::input("sort") and $query->orderBy(\Request::input("sort"),\Request::input("sortType","asc"));

        // paginate results
        return $query->paginate(15);
    }

    public static function validationRules( $attributes = null )
    {
        $rules = [
            'poi_id' => 'required|integer',
        ];

        // no list is provided
        if(!$attributes)
            return $rules;

        // a single attribute is provided
        if(!is_array($attributes))
            return [ $attributes => $rules[$attributes] ];

        // a list of attributes is provided
        $newRules = [];
        foreach ( $attributes as $attr )
            $newRules[$attr] = $rules[$attr];
        return $newRules;
    }

    # 创建一个新云图POI并与本地POI对象绑定
    public function build(Item $item)
    {
        $poi_id = $this->addPOI([
            '_name'       =>  $item->seller->real_name,
            '_address'    =>  $item->location->address,
            'category'    =>  $item->category->name,
            'office'      =>  $item->seller->office,
            'avatar'      =>  $item->seller->avatar,
            'price'       =>  $item->price,
            'consult'     =>  $item->id,
            'user'        =>  $item->seller->id,
            'counter'     =>  $item->seller->service_count,
            'recommend'   =>  $item->recommend?'yes':'no',
            'recommend_value' => $item->recommend_value
        ]);

        $this->poi_id = $poi_id;
    }

    # 删除本地和云图上的POI对象
    public function delete()
    {
        Log::info('POI删除中'.$this->id);
        # 删除云图中的数据条目
        $this->deletePOI($this->poi_id);
        # 删除系统中本地POI对象
        parent::delete();
    }

    # 更新本地和云图上的POI对象
    public function updateInfo(array $data)
    {
        # 只更新了云图中的数据，因为本地POI对象没有任何信息需要修改
        $info = array_merge([
            '_id' => $this->poi_id
        ],$data);

        $this->updatePOI($info);
    }

    # 一个POI数据项只代表一个咨询业务
    public function consult()
    {
        return $this->belongsTo(Item::class);
    }
}
