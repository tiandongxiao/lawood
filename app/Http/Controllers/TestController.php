<?php

namespace App\Http\Controllers;


use App\Cart;
use App\Item;
use App\Category;
use App\Location;
use App\Pois;
use App\Traits\GdYunMapTrait;
use App\Transaction;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Shop;
use Illuminate\Support\Facades\Auth;


class TestController extends Controller
{
    use GdYunMapTrait;

    public function putValue($key,$value)
    {
        Cache::add($key,$value,2);        

    }

    public function getValue($key){
        if(Cache::has($key)){
            dd(Cache::get($key));
        }
        dd($key.'~已失效');
    }

    public function getUri(Request $request)
    {
        //dd($request->getUri());
        //dd($request->getBaseUrl());
    }

    public function getShopFormat()
    {
       dd(Shop::format(9.99));
    }

    public function getPayMethod()
    {
        Shop::setGateWay('paypal');
        dd(Shop::getGateWay());
    }

    public function getCart()
    {
        $cart = Cart::current();
        dd($cart);
    }

    public function getPlaceOrder()
    {
        $cart = Cart::current();
        $order = $cart->placeOrder();
        dd($order);
    }

    public function getMakeCategories()
    {
        $root = Category::where('name','root')->first();
        dd($root->tree());
    }

    public function drawCategory()
    {
        $root = Category::where('name','root')->first();
        //$root = Category::findOrFail(0)->first();
        $nodes = $root->tree()[0]['nodes'];
        return view('index',compact('nodes'));
    }

    public function getHttpLocation()
    {
        //$this->createTable();
        //$this->addItem("王国营","北京市融科橄榄城","家庭");
        //$this->deleteItem('15,16');
        //$this->updateItem('20','田东晓','北京市车道沟北京气象局','旅游');
        //$this->searchItemById(20);
//        $condition = [
//            'city' => '北京市',
//        ];
//        $this->searchLocal($condition);

//        $condition =[
//            'center' => '116.481471,39.990471',
//        ];
//        $this->searchAround($condition);
        $condition = [
            'filter' => '_name:王国营+category:家庭'
        ];
        dd($this->searchByFilter($condition));
    }

    public function getLocations()
    {
        dd(Auth::user()->locations);
    }

    public function node(){
        dd(Auth::user()->orders);
    }


}
