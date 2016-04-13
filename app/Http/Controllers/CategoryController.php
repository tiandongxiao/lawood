<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    # 列举当前所有系统分类
    public function index()
    {
        $all = Category::all();
        return view('category.index');
    }

    # 添加新的系统分类
    public function create()
    {
        return view('category.create');
    }

    # 系统分类保存逻辑
    public function store(Request $request)
    {
        $parent = Category::where('name',$request->get('parent'))->first();
        $category = new Category();
        $category->name = $request->get('name');;
        $category->parent_id = $parent->id;
        $category->save();
    }

    # 显示具体系统分类信息
    public function show($id)
    {
        $category = Category::find($id);
        return view('category.show',compact('category'));
    }

    # 编辑具体系统分类信息
    public function edit($id)
    {
        $category = Category::find($id);
        return view('category.edit',compact('category'));
    }

    # 更新系统分类逻辑
    public function update(Request $request, $id)
    {
        $parent = Category::where('name',$request->get('parent'))->first();

        $category = Category::find($id);
        $category->name = $request->get('name');;
        $category->parent_id = $parent->id;
        $category->save();

    }

    # 删除一个系统分类
    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();
    }
}
