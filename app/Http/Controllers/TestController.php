<?php

namespace App\Http\Controllers;



use App\Category;
use App\Item;
use App\Traits\GaodeMapTrait;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

use Shop;
use Illuminate\Support\Facades\Auth;
use Bican\Roles\Models\Role;
use Bican\Roles\Models\Permission;
use App\Place;
use EasyWeChat\Core\AccessToken;


class TestController extends Controller
{
    use GaodeMapTrait;

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

    public function ratingUser()
    {
        $user = User::first();
        $user_2 = User::find(2);

        $user->rating([
            'rating' => rand(1,5)
        ],$user_2);

        $rating = ceil($user->averageRating());

        dd($rating);
    }

    public function scanQrCode()
    {
        $url = action('RoleController@show', ['id' => 1]);
        return view('test.qr',compact('url'));
    }

    public function lists()
    {
        $items = Item::all();
        return view('test.list',compact('items'));
    }
    public function like($id)
    {
        $user_id = Auth::user()->id;
        $item = Item::findOrFail($id);
        $item->like($user_id);
        return back();

    }

    public function unlike($id)
    {
        //$user_id = Auth::user()->id;
        
        $item = Item::findOrFail($id);
        if($item->liked()){
            $item->unlike();
        }
        return back();
    }

    public function faker()
    {
        $all = factory(Place::class, 100)->create();
    }

    public function getToken(){
//        $token = Cache::get('wx_access_token');
//        dd($token);
        $appId = config('services.wechat.client_id');
        $secret = config('services.wechat.client_secret');
        //dd($appId.'@'.$secret);

        $accessToken = new AccessToken($appId, $secret);

        # token 字符串
        $token = $accessToken->getToken();

        dd($token);
    }

    public function eraseCache()
    {
        Cache::forget('wx_access_token');
        $token = Cache::get('wx_access_token');
        dd($token);
    }
}
