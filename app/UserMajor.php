<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Ghanem\Rating\Contracts\Ratingable;
use Ghanem\Rating\Traits\Ratingable as RatingTrait;

class UserMajor extends Model implements Ratingable
{
    use RatingTrait;

    protected $fillable = ['item_id','user_id','category_id'];

    # 获取原始咨询项
    public function consult()
    {
        return $this->belongsTo(Item::class);
    }

    public function getCategoryAttribute()
    {
        if($this->category_id){
            return Category::findOrFail($this->category_id);
        }
        return null;        
    }

    public function delete()
    {
        $this->ratings->delete();
        parent::delete();
    }
}
