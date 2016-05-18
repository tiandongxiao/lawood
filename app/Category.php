<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use VergilLai\NodeCategories\NodeCategoryTrait;

class Category extends Model
{
    use NodeCategoryTrait;

    # 一个分类拥有多条咨询项, 系统级别
    public function consults()
    {
        return $this->hasMany(Item::class);
    }

    # 一个分类属于多个律师执业范围，系统级别
    public function users()
    {
        return $this->hasMany(User::class);
    }

    # !! 系统级别的删除，所有律师的相关咨询服务项都会删除
    public function delete()
    {
        $consults = $this->consults;
        foreach($consults as $consult){
            $consult->delete();
        }
        parent::delete();
    }

    public function nodes()
    {
        $root = Category::where('name','root')->first();
        $nodes = $root->tree()[0]['nodes'];
        return $nodes;
    }
}
