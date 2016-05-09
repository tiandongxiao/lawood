<?php
namespace App\Http\Controllers;

use App\Notification;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public $viewDir = "notification";

//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    # CRUD 列举所有
    public function index()
    {
        $records = Notification::findRequested();
        return $this->view( "index", ['records' => $records] );
    }

    # CRUD 查看
    public function show(Request $request, Notification $notification)
    {
        return $this->view("show",['notification' => $notification]);
    }

    # CRUD 删除
    public function destroy(Request $request, Notification $notification)
    {
        $notification->delete();
        return redirect('/notification');
    }

    protected function view($view, $data = [])
    {
        return view($this->viewDir.".".$view, $data);
    }
}
