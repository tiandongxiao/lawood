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
            return $result;
        }
    }

    public function stop(Request $request)
    {
        if($request->ajax()){
            $user = User::findOrFail($request->get('user'));
            $result = $user->stop();
            return $result;
        }
    }
}
