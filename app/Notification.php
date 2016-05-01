<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class Notification extends Model {

    public $guarded = ["id","created_at","updated_at"];

    public static function findRequested()
    {
        $query = Notification::query();

        # search results based on user input
        Request::input('user_id') and $query->where('user_id',Request::input('user_id'));
        Request::input('type') and $query->where('type','like','%'.Request::input('type').'%');
        Request::input('title') and $query->where('title','like','%'.Request::input('title').'%');
        Request::input('url') and $query->where('url','like','%'.Request::input('url').'%');
        Request::input('read') and $query->where('read',Request::input('read'));
        Request::input('content') and $query->where('content','like','%'.Request::input('content').'%');
        Request::input('created_at') and $query->where('created_at',Request::input('created_at'));
        
        # sort results
        Request::input("sort") and $query->orderBy(Request::input("sort"),Request::input("sortType","asc"));

        # paginate results
        return $query->paginate(15);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
