<?php

namespace App\Http\Controllers;

use App\Item;
use App\Notification;
use App\Price;
use App\Self\Notify\NotifyFacade;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use App\Order;


class AjaxController extends Controller
{
    # * ------------------ 用户操作的 ajax 请求 ------------------ * #

    public function start(Request $request)
    {
        if($request->ajax()){
            $user = User::findOrFail($request->get('user'));
            $result = $user->start();
            if($result)
                return 'Y';
            return 'X';
        }
    }

    public function stop(Request $request)
    {
        if($request->ajax()){
            $user = User::findOrFail($request->get('user'));
            $result = $user->stop();
            if($result)
                return 'Y';
            return 'X';
        }
    }


    # * ------------------ 验证性的 ajax 请求 ------------------ * #

    public function sms(Request $request)
    {
        if($request->ajax()){
            $phone = $request->get('phone');
            switch ($request->get('do')){
                case 'reg':
                case 'reset':
                case 'check':
                    $data['do'] = $request->get('do');
                    $data['tpl'] = '74240';  # 短信模板
                    $key = $data['do'].'_'.$phone;
                    if(!Cache::has($key)){
                        $data['content'] = array((string)random_int(1000, 9999)); # 要求必须是数组
                    }else{
                        $code = Cache::get($key);
                        $data['content'] = array($code); # 要求必须是数组
                    }
                    break;
                default:
                    $data['do'] = $request->get('do');
                    $data['tpl'] = '74240';
                    $data['content'] = '';
                    break;
            }
            $result = \Notify::sendSMS($phone,$data);

            if($result){
                switch ($data['do']){
                    case 'reg':
                    case 'reset':
                    case 'check':
                        $key = $data['do'].'_'.$phone;
                        if(!Cache::has($key))
                            Cache::add($key, $data['content'][0], 30);
                        return response()->json(['code' => 'Y', 'info' => '验证码发送成功']);
                    default:
                        return response()->json(['code' => 'Y', 'info' => '信息发送成功']);
                }
            }
            switch ($data['do']){
                case 'reg':
                case 'reset':
                case 'check':
                    return response()->json(['code' => 'X', 'info' => '验证码发送失败']);
                default:
                    return response()->json(['code' => 'X', 'info' => '信息发送失败']);
            }
        }
    }

    public function phone(Request $request)
    {
        $phone = $request->get('phone');
        if($request->ajax()){
            $record = User::where('phone',$phone)->first();
            if(is_null($record))
                return 'Y';
            return 'X';
        }
    }

    public function code(Request $request)
    {
        if($request->ajax()){
            $type =  $request->get('type');
            $phone = $request->get('phone');
            $key = $type.'_'.$phone;

            if(!Cache::has($key))
                return 'E';

            $value = Cache::get($key);

            if($request->get('code') != $value)
                return 'X';

            Cache::forget($key);
            return 'Y';
        }
    }

    # * ------------------ 验证性的 ajax 请求 ------------------ * #
    public function price(Request $request)
    {
        if($request->ajax()){
            $id = $request->get('price');
            $price = Price::find($id);
            if($price && $price->price){
                return response()->json(['code' => 'Y', 'data' => $price->price]);
            }
            return response()->json(['code' => 'X', 'data' => null]);
        }
    }

    public function evaluate(Request $request)
    {
        if($request->ajax()){
            $id = $request->get('order');
            $order = Order::find($id);

            if($order){
                $data = [ ];
                if($order->rating){
                    $data['rating'] = $order->rating->rating;
                }
                if($order->comment){
                    $data['comment'] = $order->comment->body;
                }
                return response()->json(['code' => 'Y', 'data' => $data]);
            }
            return response()->json(['code' => 'X', 'data' => null]);
        }
    }

    public function consult_liked(Request $request)
    {
        if($request->ajax()){
            $client_id = trim($request->get('client'));
            $consult_id = trim($request->get('consult'));
            $operate = trim($request->get('operate'));

            $client = null;
            $consult = null;

            if($client_id){
                $client = User::find($client_id);
            }
            if($consult_id){
                $consult = Item::find($consult_id);
            }

            if($client && $consult){
                switch ($operate){
                    case 'like':
                        $consult->like($client->id);
                        if($consult->liked($client->id)){
                            return response()->json(['code' => 'Y', 'data' => $operate]);
                        }else{
                            return response()->json(['code' => 'X', 'data' => $operate]);
                        }
                        break;
                    case 'unlike':
                        $consult->unlike($client->id);
                        if(!$consult->liked($client->id)){
                            return response()->json(['code' => 'Y', 'data' => $operate]);
                        }else{
                            return response()->json(['code' => 'X', 'data' => $operate]);
                        }
                        break;
                }
            }
            return response()->json(['code' => 'X', 'data' => $operate]);
        }
    }

    public function receipt(Request $request)
    {        
        if($request->ajax()){
            $user_id = trim($request->get('user'));
            $order_id = trim($request->get('order'));
            $order = Order::find($order_id);
            if($order && $order->receipt){
                if($order->user->id == $user_id){
                    $receipt = $order->receipt;
                    $data = [
                        'info'      => 'success',
                        'avatar'    =>  $order->user->avatar,
                        'title'     =>  $receipt->title,
                        'receiver'  =>  $receipt->receiver,
                        'address'   =>  $receipt->address,
                        'phone'     =>  $receipt->phone
                    ];
                    return response()->json(['code' => 'Y', 'data' => $data]);
                }
            }
            return response()->json(['code' => 'X', 'data' => ['info'=>'failed']]);
        }
    }

}
