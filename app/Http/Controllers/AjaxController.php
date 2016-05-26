<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AjaxController extends Controller
{
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
}
