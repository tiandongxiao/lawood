<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CheckController extends Controller
{
    public function phone(Request $request)
    {
        $phone = $request->get('phone');
        if($request->ajax()){
            $record = User::where('phone',$phone)->first();
            if($record)
                return 'Y';
            return 'X';
        }
    }

    public function email(Request $request)
    {
        $email = trim($request->get('email'));
        if($request->ajax()){
            $result = User::where('email',$email)->first();
            if($result)
                return 'EXIST';
        }
        return 'OK';
    }

    public function code(Request $request)
    {
        if($request->ajax()){
            $type =  $request->get('todo');
            $phone = $request->get('phone');
            $key = $type.'_'.$phone;

            if(!Cache::has($key)){
                return 'E';
            }

            $value = Cache::get($key);
            Cache::forget($key);

            if($request->get('code') != $value){
                return 'X';
            }
            return 'Y';
        }
    }
}
