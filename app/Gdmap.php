<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Gdmap extends Model {

    public $guarded = ["id","created_at","updated_at"];

    public static function findRequested()
    {
        $query = Gdmap::query();

        // search results based on user input
        \Request::input('id') and $query->where('id',\Request::input('id'));
        \Request::input('address') and $query->where('address','like','%'.\Request::input('address').'%');
        \Request::input('category') and $query->where('category','like','%'.\Request::input('category').'%');
        \Request::input('name') and $query->where('name','like','%'.\Request::input('name').'%');
        // sort results
        \Request::input("sort") and $query->orderBy(\Request::input("sort"),\Request::input("sortType","asc"));

        // paginate results
        return $query->paginate(15);
    }

    public static function validationRules( $attributes = null )
    {
        $rules = [
            'address' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'name' => 'required|string|max:40',
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

    public function item()
    {
        return $this->belongsTo('App\Item');
    }

}
