<?php

namespace App\Http\Controllers;


use App\Item;
use App\User;
use App\UserTiming;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Place;
use \Notify;

class TestController extends Controller
{
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

    public function cache()
    {
        dd(Cache::get('order')->consult);
//        if(Session::has('hello'))
//            dd(Session::get('hello'));
//        $this->searchPublicAround([
//            'query'    => '咖啡',
//            'location' => '31.204055632862,121.41117785465',
//            'radius'   => '1000',
//            'region'   => '上海'
//        ]);
//        $price = Price::findOrFail(5);
//        dd($price->consults);
//        $users = User::where('role','lawyer')->where('active',true)->get();
//        dd($users);
//        if(Cache::has('reg_18301191705'))
//            dd(Cache::get('reg_18301191705'));
//        $adminRole = Role::where('slug','admin')->first();
//        $admin = User::where('email','admin@lawood.cn')->first();
//        $admin->attachRole($adminRole);
//        Notify::send(1,2);
//        $value = Cache::get($key);
//        if($value){
//            dd($value);
//        }
//        dd('No');
    }

    public function putValue()
    {
        dd(Cache::get('order')->user);
        //Cache::add('reg_18301191705',random_int(1000, 9999),2);
        //session('hello','good');
        //Session::put('hello','good');
    }

    public function buildNotifications()
    {
        $lawyer = User::where('email','lawyer@lawood.cn')->first();
        Notify::send($lawyer,['type'=>'ad','item_id'=>random_int(1, 10)]);

//        $item = Item::find(1);
//
//        $comment = $item->comment([
//            'title' => 'hello',
//            'body'  => 'I am body'
//        ],Auth::user());
//        dd(Auth::user()->comments);

//        $lawyer = User::where('email','lawyer@lawood.cn')->first();
//
//        $comment = $lawyer->comment([
//            'title' => 'hello',
//            'body'  => str_random(23)
//        ],Auth::user());
//        dd($lawyer->comments);
        $lawyer = User::where('email','lawyer@lawood.cn')->first();
        dd($lawyer->consults);

        //dd($lawyer->dressing->ratings);
        //dd($lawyer->timing->ratings);
        dd($lawyer->polite->ratings);
//        $time = new UserPolite();
//        $time->save();
//        dd($time);

//        $user = User::find(1);
//        dd($user->created_at->diffForHumans());
        //$user = User::where('email',$email)->first();
        #factory(Notification::class, 20)->create();
    }

    public function entityPerm()
    {
        $edit_perm = Permission::create([
            'name' => 'Edit notification',
            'slug' => 'edit.notification',
            'model' => 'App\Notification',
        ]);
    }

    public function timing()
    {
        $time = new UserTiming();
        $time->save();
        dd($time);
    }

    public function call()
    {
        return view('test.call');
    }
}
