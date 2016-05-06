<?php
/**
 * Created by PhpStorm.
 * User: tiandongxiao
 * Date: 06/05/2016
 * Time: 14:56
 */

namespace App\Traits;


use App\Category;

trait CategoryDevTrait
{
    # 显示当前律师的业务类别
    public function categories()
    {
        $binds = $this->user->categories;
        $unbinds = $this->getUnbindCategories();
        return view('lawyer.category.index',compact('binds','unbinds'));
    }

    # 增加一个新的业务类别
    public function bindCategory($id)
    {
        $count = $this->user->categories()->count();
        if( $count < 4) {
            $category = Category::findOrFail($id);

            if (!$this->hasCategory($category->id)) {
                $this->user->categories()->attach($category->id);
                return redirect('lawyer/categories');
            }

            return back()->withErrors('您已填加此分类，不能重复添加');
        }
        return back()->withErrors('每个律师至多只能选择4项业务范围');
    }

    # 删除某个业务类别
    public function unbindCategory($id)
    {
        if($this->hasCategory($id)){
            # 当律师删除一个业务门类时，将相关的业务咨询服务都删除
            $items = Auth::user()->items;

            foreach($items as $item){
                if($item->category_id == $id){
                    $item->delete();
                }
            }
            $this->user->categories()->detach($id);

            return redirect('lawyer/categories');
        }
    }

    # 判断是否有某个业务类别
    public function hasCategory($cate_id)
    {
        foreach($this->user->categories as $category){
            if($category->id == $cate_id)
                return true;
        }
        return false;
    }

    # 获取当前律师没有提供的业务范围
    public function getUnbindCategories()
    {
        $unbinds = [];
        $categories = Category::all();

        foreach($categories as $category){
            if($category->level == 3 && !$this->hasCategory($category->id)){
                $unbinds[] = $category;
            }
        }
        return $unbinds;
    }
}