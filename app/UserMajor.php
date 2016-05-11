<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Ghanem\Rating\Contracts\Ratingable;
use Ghanem\Rating\Traits\Ratingable as RatingTrait;

class UserMajor extends Model implements Ratingable
{
    use RatingTrait;

    protected $fillable = ['item_id'];

    public function consult()
    {
        return $this->belongsTo(Item::class);
    }
}
