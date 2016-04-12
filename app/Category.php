<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use VergilLai\NodeCategories\NodeCategoryTrait;

class Category extends Model
{
    use NodeCategoryTrait;

    /**
     * 一个分类拥有多条咨询项
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function consults()
    {
        return $this->hasMany('App\Item');
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
