<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Rap2hpoutre\LaravelLogViewer\LaravelLogViewer;

class WebsiteController extends Controller
{

    public function index()
    {
        return view('website.snow');
    }

    public function welcome()
    {
        return view('welcome');
    }

    public function regByQrCode()
    {
        return view('auth.qr_code');
    }

    public function logs()
    {
        if (Request::input('l')) {
            LaravelLogViewer::setFile(base64_decode(Request::input('l')));
        }

        if (Request::input('dl')) {
            return Response::download(LaravelLogViewer::pathToLogFile(base64_decode(Request::input('dl'))));
        } elseif (Request::has('del')) {
            File::delete(LaravelLogViewer::pathToLogFile(base64_decode(Request::input('del'))));
            return Redirect::to(Request::url());
        }

        $logs = LaravelLogViewer::all();

        return view('website.logs',[
            'logs' => $logs,
            'files' => LaravelLogViewer::getFiles(true),
            'current_file' => LaravelLogViewer::getFileName()
        ]);
    }
}
