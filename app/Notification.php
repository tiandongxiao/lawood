<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model {

    public $guarded = ["id","created_at","updated_at"];

    public static function findRequested()
    {
        $query = Notification::query();

        // search results based on user input
        \Request::input('id') and $query->where('id',\Request::input('id'));
        \Request::input('user_id') and $query->where('user_id',\Request::input('user_id'));
        \Request::input('type') and $query->where('type','like','%'.\Request::input('type').'%');
        \Request::input('title') and $query->where('title','like','%'.\Request::input('title').'%');
        \Request::input('url') and $query->where('url','like','%'.\Request::input('url').'%');
        \Request::input('read') and $query->where('read',\Request::input('read'));
        \Request::input('content') and $query->where('content','like','%'.\Request::input('content').'%');
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
            'user_id' => 'required|integer',
            'type' => 'required|string|max:24',
            'title' => 'required|string|max:64',
            'url' => 'string|max:255',
            'read' => 'required',
            'content' => 'string|max:128',
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

}
