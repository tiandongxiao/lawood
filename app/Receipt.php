<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Receipt extends Model {

    public $guarded = ["id","created_at","updated_at"];

    public static function findRequested()
    {
        $query = Receipt::query();

        // search results based on user input
        \Request::input('id') and $query->where('id',\Request::input('id'));
        \Request::input('order_id') and $query->where('order_id',\Request::input('order_id'));
        \Request::input('receiver') and $query->where('receiver','like','%'.\Request::input('receiver').'%');
        \Request::input('title') and $query->where('title','like','%'.\Request::input('title').'%');
        \Request::input('address') and $query->where('address','like','%'.\Request::input('address').'%');
        \Request::input('code') and $query->where('code','like','%'.\Request::input('code').'%');
        \Request::input('phone') and $query->where('phone','like','%'.\Request::input('phone').'%');
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
            'order_id' => 'required',
            'receiver' => 'required|string|max:255',
            'title' => 'required|string|max:80',
            'address' => 'required|string|max:128',
            'phone' => 'required|string|max:15',
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

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

}
