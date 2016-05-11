<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Ghanem\Rating\Contracts\Ratingable;
use Ghanem\Rating\Traits\Ratingable as RatingTrait;

class UserPolite extends Model implements Ratingable
{
    use RatingTrait;

    protected $fillable = ['user_id'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
