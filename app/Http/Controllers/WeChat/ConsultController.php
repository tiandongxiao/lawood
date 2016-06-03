<?php
/**
 * Created by PhpStorm.
 * User: tiandongxiao
 * Date: 16/05/2016
 * Time: 17:18
 */

namespace App\Http\Controllers\WeChat;


use App\Http\Controllers\Controller;
use App\Item;
use Illuminate\Support\Facades\Auth;

class ConsultController extends Controller
{
    public function index()
    {
        $consults = Item::consults();
        return view('wechat.consults',compact('consults'));
    }

    public function placeOrder($id)
    {
        $consult = Item::findOrFail($id);
        if(Auth::check()){
            switch (Auth::user()->role){
                case 'lawyer':
                    break;
                case 'client':
                    break;
            }
        }
    }
}