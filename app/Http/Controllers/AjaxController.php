<?php

namespace App\Http\Controllers;

use App\Notification;
use App\Price;
use App\Self\Notify\NotifyFacade;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;


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
                    $data['do'] = $request->get('do');
                    $data['tpl'] = '74240';  # 短信模板
                    $data['content'] = array((string)random_int(1000, 9999)); # 要求必须是数组
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
                        Cache::add($data['do'].'_'.$phone, $data['content'][0], 1);
                        return response()->json(['code' => 200, 'info' => '验证码发送成功']);
                    default:
                        return response()->json(['code' => 200, 'info' => '信息发送成功']);
                }
            }
            switch ($data['do']){
                case 'reg':
                case 'reset':
                    return response()->json(['code' => 400, 'info' => '验证码发送失败']);
                default:
                    return response()->json(['code' => 400, 'info' => '信息发送失败']);
            }
        }
    }

    public function phone(Request $request)
    {
        $phone = $request->get('phone');
        Log::info('进行验证的手机号码 - '.$phone);
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
            Log::info($key);

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
                    $data['rating'] = $order->rating->score;
                }
                if($order->comment){
                    $data['comment'] = $order->comment->body;
                }
                return response()->json(['code' => 'Y', 'data' => $data]);
            }
            return response()->json(['code' => 'X', 'data' => null]);
        }
    }
}
