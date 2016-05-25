<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class CheckController extends Controller
{
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

    public function email(Request $request)
    {
        $email = trim($request->get('email'));
        if($request->ajax()){
            $result = User::where('email',$email)->first();
            if(is_null($result))
                return 'Y';
        }
        return 'X';
    }

    public function code(Request $request)
    {
        return 'Y';
        if($request->ajax()){
            $type =  $request->get('todo');
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
}
