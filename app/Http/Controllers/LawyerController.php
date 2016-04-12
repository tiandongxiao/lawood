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
    /**
     *
     */
    public function index()
    {

    }

    /**
     * 列举出所有的业务咨询服务
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getConsults()
    {
        $consults = Auth::user()->items;
        return view('lawyer.consults',compact('consults'));
    }

    /**
     * 查看一个具体业务咨询信息
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function displayConsultDetail($id)
    {
        $consult = Item::find($id);
        return view('lawyer.consult',compact('consult'));
    }

    /**
     * 显示当前律师的业务范围
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getCategories()
    {
        $categories = Auth::user()->categories;
        $unbinds = $this->getUnbindCategories();
        return view('lawyer.categories',compact('categories','unbinds'));
    }

    /**
     * 增加一个业务范围
     *
     * @param $id
     */
    public function addCategory($id)
    {
        $category = Category::find(random_int(5,15));
        echo $category->name;
        if($this->hasCategory($category->id)){
            dd('您已填加此分类，不能重复添加');
        }
        Auth::user()->categories()->attach($category->id);
        dd(Auth::user()->categories);
    }

    /**
     * 判断是否有某个业务范围
     *
     * @param $cate_id
     * @return bool
     */
    public function hasCategory($cate_id)
    {
        foreach(Auth::user()->categories as $category){
            if($category->id == $cate_id)
                return true;
        }
        return false;
    }

    /**
     * 删除某个业务范围
     *
     * @param $id
     */
    public function deleteCategory($id)
    {
        if($this->hasCategory($id)){
            Auth::user()->categories()->detach($id);
        }
    }

    /**
     * 获取当前律师没有提供的业务范围
     *
     * @return array
     */
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

    /**
     * 获得当前律师提供的业务范围
     *
     * @return mixed
     */
    public function getBindCategories()
    {
        return Auth::user()->categories;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getBindLocations()
    {
        $locations = Auth::user()->locations;
        return view('lawyer.locations',compact('locations'));
    }


}
