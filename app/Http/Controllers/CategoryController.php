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
        return view('category.index');
    }

    # 添加新的系统分类
    public function create()
    {

    }

    # 系统分类保存逻辑
    public function store(Request $request)
    {
        //
    }

    # 显示具体系统分类信息
    public function show($id)
    {
        //
    }

    # 编辑具体系统分类信息
    public function edit($id)
    {
        //
    }

    # 更新系统分类逻辑
    public function update(Request $request, $id)
    {
        //
    }

    # 删除一个系统分类
    public function destroy($id)
    {
        //
    }
}
