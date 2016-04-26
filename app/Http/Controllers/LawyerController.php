<?php

namespace App\Http\Controllers;

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
        return view('category.list',compact('binds','unbinds'));
    }

    # 增加一个新的业务类别
    public function bindCategory($id)
    {
        $category = Category::find($id);

        if(!$this->hasCategory($category->id)){
            Auth::user()->categories()->attach($category->id);
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

            Auth::user()->categories()->detach($id);
            return redirect('category');
        }
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

    # 已完成的订单
    public function completedOrders()
    {
        $user = $this->getUser();
        $orders = $this->getCompletedOrders($user);
        return view('lawyer.status.completed',compact('orders'));
    }

    # 已付款，尚未承接的订单
    public function payedOrders()
    {
        $user = $this->getUser();
        $orders = $this->getPayedOrders($user);
        return view('lawyer.status.payed',compact('orders'));
    }

    # 已经承接的订单
    public function acceptedOrders()
    {
        $user = $this->getUser();
        $orders = $this->getAcceptedOrders($user);
        return view('lawyer.status.accepted',compact('orders'));
    }

    # 拒绝的订单
    public function rejectedOrders()
    {
        $user = $this->getUser();
        $orders = $this->getRejectedOrders($user);
        return view('lawyer.status.rejected',compact('orders'));
    }

    # 提款
    public function withdraw()
    {
        $user = $this->getUser();
        $sum = $this->account($user);

        dd($sum);
    }

    public function getUser()
    {
        $user = Auth::user();
        $user->role = 'lawyer';
        $user->save();
        return $user;
    }

    public function account($user)
    {
        $orders = $this->getPayedOrders($user);
        $sum = 0;

        foreach($orders as $order){
            $sum += $order->total;
        }
        return $sum/100;
    }
}
