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
        $phone = trim($request->get('phone'));
        if($request->ajax()){
            $result = User::where('phone',$phone)->first();
            if($result)
                return 'EXIST';
        }
        return 'OK';
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
}
