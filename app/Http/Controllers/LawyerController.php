<?php

namespace App\Http\Controllers;

use App\Category;
use App\Item;
use App\Post;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class LawyerController extends Controller
{
    # 律师主页
    public function index()
    {
        return view('lawyer.main');
    }

    # 显示当前律师的业务类别
    public function getCategories()
    {
        $binds = Auth::user()->categories;
        $unbinds = $this->getUnbindCategories();
        return view('lawyer.categories',compact('binds','unbinds'));
    }

    # 增加一个新的业务类别
    public function addCategory($id)
    {
        $category = Category::find($id);

        if(!$this->hasCategory($category->id)){
            Auth::user()->categories()->attach($category->id);
            return redirect('lawyer/categories');
        }

        return back()->withErrors('您已填加此分类，不能重复添加');
    }

    # 判断是否有某个业务类别
    public function hasCategory($cate_id)
    {
        foreach(Auth::user()->categories as $category){
            if($category->id == $cate_id)
                return true;
        }
        return false;
    }

    # 删除某个业务类别
    public function deleteCategory($id)
    {
        if($this->hasCategory($id)){
            Auth::user()->categories()->detach($id);
            return redirect('lawyer/categories');
        }
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
