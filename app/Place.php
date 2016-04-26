<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class Place extends Model {

    public $guarded = ["id","created_at","updated_at"];

    public static function findRequested()
    {
        $query = Place::query();
        # 根据用户输入搜索信息
        Request::input('id') and $query->where('id',Request::input('id'));
        Request::input('name') and $query->where('name','like','%'.Request::input('name').'%');
        Request::input('price') and $query->where('price',\Request::input('price'));
        Request::input('avatar') and $query->where('avatar','like','%'.Request::input('avatar').'%');
        Request::input('desc') and $query->where('desc','like','%'.Request::input('desc').'%');
        Request::input('address') and $query->where('address','like','%'.Request::input('address').'%');
        Request::input('attach') and $query->where('attach','like','%'.\Request::input('attach').'%');
        Request::input('created_at') and $query->where('created_at',Request::input('created_at'));
        Request::input('updated_at') and $query->where('updated_at',Request::input('updated_at'));
        
        # 对结果进行排序
        Request::input("sort") and $query->orderBy(\Request::input("sort"),Request::input("sortType","asc"));

        # 对结果进行分页
        return $query->paginate(15);
    }

    public static function validationRules( $attributes = null )
    {
        $rules = [
            'name' => 'required|string|max:128',
            'price' => 'required',
            'avatar' => 'required|string|max:255',
            'desc' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'attach' => 'required|string|max:255',
        ];

        # no list is provided
        if(!$attributes)
            return $rules;

        # a single attribute is provided
        if(!is_array($attributes))
            return [ $attributes => $rules[$attributes] ];

        # a list of attributes is provided
        $newRules = [];
        foreach ( $attributes as $attr )
            $newRules[$attr] = $rules[$attr];
        return $newRules;
    }
}
