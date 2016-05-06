<?php

namespace App\Http\Controllers\User;

use App\Category;
use App\Item;
use App\Post;
use App\Traits\ShopDevTrait;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class LawyerController extends Controller
{
    use ShopDevTrait;

    private $user;

    public function __construct()
    {
        $this->middleware('auth',['except'=>'board']);
        $this->middleware('role:lawyer',['except'=>'board']);
        $this->user = Auth::user();
    }

    # 总览面板
    public function board()
    {
        return view('lawyer.board');
    }

    # 显示当前律师的业务类别
    public function categories()
    {
        $binds = $this->user->categories;
        $unbinds = $this->getUnbindCategories();
        return view('category.list',compact('binds','unbinds'));
    }

    # 增加一个新的业务类别
    public function bindCategory($id)
    {
        $category = Category::findOrFail($id);

        if(!$this->hasCategory($category->id)){
            $this->user->categories()->attach($category->id);
            return redirect('category');
        }

        return back()->withErrors('您已填加此分类，不能重复添加');
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
            return redirect('category');
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

    public function locations()
    {
        $locations = $this->user->locations;
        return view('lawyer.locations',compact('locations'));
    }

    # 已完成的订单
    public function completedOrders()
    {
        $orders = $this->getCompletedOrders($this->user);
        return view('lawyer.order.completed',compact('orders'));
    }

    # 已付款，尚未承接的订单
    public function payedOrders()
    {
        $orders = $this->getPayedOrders($this->user);
        return view('lawyer.order.payed',compact('orders'));
    }

    # 已经承接的订单
    public function acceptedOrders()
    {
        $orders = $this->getAcceptedOrders($this->user);
        return view('lawyer.order.accepted',compact('orders'));
    }

    # 拒绝的订单
    public function rejectedOrders()
    {
        $orders = $this->getRejectedOrders($this->user);
        return view('lawyer.order.rejected',compact('orders'));
    }

    # 提款
    public function withdraw()
    {
        $sum = $this->account();
        dd($sum);
    }

    public function account()
    {
        $orders = $this->getPayedOrders($this->user);
        $sum = 0;

        foreach($orders as $order){
            $sum += $order->total;
        }
        return $sum/100;
    }
}
