<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model {

    public $guarded = ["id","created_at","updated_at"];

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public static function findRequested()
    {
        $query = Location::query();

        // search results based on user input
        \Request::input('id') and $query->where('id',\Request::input('id'));
        \Request::input('type') and $query->where('type','like','%'.\Request::input('type').'%');
        \Request::input('address') and $query->where('address','like','%'.\Request::input('address').'%');
        
        // sort results
        \Request::input("sort") and $query->orderBy(\Request::input("sort"),\Request::input("sortType","asc"));

        // paginate results
        return $query->paginate(15);
    }

    /**
     * @param null $attributes
     * @return array
     */
    public static function validationRules($attributes = null )
    {
        $rules = [
            'type' => 'required|string|max:20',
            'address' => 'required|string|max:255',
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


    # 地址是私有概念，一个地址只属于一个用户
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    # 一个地址可以做多种咨询业务
    public function consults()
    {
        return $this->hasMany('App\Item');
    }

}
