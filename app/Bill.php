<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class Bill extends Model {

    public $guarded = ["id","created_at","updated_at"];

    public static function findRequested()
    {
        $query = Bill::query();

        Request::input('id') and $query->where('id',Request::input('id'));
        Request::input('user_id') and $query->where('user_id',Request::input('user_id'));
        Request::input('name') and $query->where('name',Request::input('name'));
        Request::input('amount') and $query->where('amount',Request::input('amount'));
        Request::input('account') and $query->where('account',Request::input('account'));
        Request::input('done') and $query->where('done',Request::input('done'));
        Request::input('created_at') and $query->where('created_at',Request::input('created_at'));
        Request::input('updated_at') and $query->where('updated_at',Request::input('updated_at'));
        
        # sort results
        Request::input("sort") and $query->orderBy(Request::input("sort"),Request::input("sortType","asc"));

        # paginate results
        return $query->paginate(15);
    }

    public static function validationRules( $attributes = null )
    {
        $rules = [
            'user_id' => 'integer',
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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
