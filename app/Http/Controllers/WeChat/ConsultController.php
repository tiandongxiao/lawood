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
use App\Traits\AgentDevTrait;
use Illuminate\Support\Facades\Auth;

class ConsultController extends Controller
{
    use AgentDevTrait;

    public function __construct()
    {
        
    }

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
                    return back();
                case 'client':
                    if (Agent::isMobile()) {
                        # 如果是微信浏览器
                        if (strpos(Agent::getUserAgent(), 'MicroMessenger') !== false)
                            return redirect('wxpay/js/' . $id);
                    }
                    return redirect('wxpay/native/' . $id);
                    break;
            }
        }
        return view('wechat.qrcode');
    }

    public function selectPlace()
    {
        return view('wechat.flow.place_select');
    }

    public function postSelectPlace()
    {
        return view();
    }
}