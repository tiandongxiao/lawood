<?php

namespace App\Http\Controllers;


use App\Cart;
use App\Item;
use App\Category;
use App\Location;
use App\Pois;
use App\Traits\GdYunMapTrait;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Uri;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Efriandika\LaravelSettings\Facades\Settings;
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

    public function createItem()
    {

        $category =  Category::find(random_int(5,16));

        $location =  Location::find(random_int(1,5));

        $poi = new Pois();
        $poi->build($location,$category);

        $item = Item::create([
            'user_id'           => Auth::user()->id,
            'price' 			=> random_int(100,200),
            'sku'				=> str_random(15),
            'description'		=> str_random(500),
            'category_id'       => $category->id,
            'location_id'       => $location->id
        ]);

        $item->poi()->save($poi);
        dd($item->poi);
    }

    public function deleteItem()
    {
        $item =  Auth::user()->items()->first();
        $item->poi->delete();
        $item->delete();
    }

    public function getUpdateItem()
    {
        $item =  Auth::user()->items()->first();
        return view('consult.update',compact($item));
    }

    public function postUpdateItem(Request $request,Item $item)
    {

    }




    public function getItems()
    {
       dd(Auth::user()->items);
    }

    public function addItemIntoCart()
    {

        $products = [];

        while (count($products) < 3) {
            $products[] = Item::create([
                'price' 			=> count($products) + 0.99,
                'sku'				=> str_random(15),
                'name'				=> str_random(64),
                'description'		=> str_random(500),
            ]);
        }

        $cart = Cart::current();
        // Adds unexistent item model PROD0001
        $cart->add($products[0]);
        $cart->add($products[1]);
        $cart->add($products[2]);
        $cart->add(['sku' => 'PROD0001', 'price' => 9.99]);
        dd(Auth::user()->items);
        dd($cart->items);
    }

    public function removeItemFromCart($id)
    {
        $item  = Item::find($id);
        if($item){
            $cart = Cart::current();
            $cart->remove($item);
            dd($cart->count);
        }
        dd('查无此货');
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

    public function allCates()
    {
        $cates = Category::all()->lists('name');


        $categories = Auth::user()->categories;

        foreach($cates as $category){

        }



    }

    public function inCategories($name)
    {

    }
}
