<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Price extends Model {

    public $guarded = ["id","created_at","updated_at"];

    public static function findRequested()
    {
        $query = Price::query();

        // search results based on user input
        \Request::input('id') and $query->where('id',\Request::input('id'));
        \Request::input('user_id') and $query->where('user_id',\Request::input('user_id'));
        \Request::input('category_id') and $query->where('category_id',\Request::input('category_id'));
        \Request::input('price') and $query->where('price',\Request::input('price'));
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
            'category_id' => 'required|integer',
            'price' => 'required',
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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getCategoryAttribute()
    {
        return Category::findOrFail($this->category_id);
    }

    public function getConsultsAttribute()
    {
        dd($this->user());
        return $this->user->consults()->where('category_id',$this->category_id)->get();
    }

    public function consult($poi)
    {
        foreach ($this->consults as $consult){
            if($consult->poi->poi_id == $poi)
                return $consult;
        }
        return null;
    }
}
