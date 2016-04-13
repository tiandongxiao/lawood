<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use VergilLai\NodeCategories\NodeCategoryTrait;

class Category extends Model
{
    use NodeCategoryTrait;

    # 一个分类拥有多条咨询项
    public function consults()
    {
        return $this->hasMany('App\Item');
    }

    # 一个分类属于多个律师执业范围
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
