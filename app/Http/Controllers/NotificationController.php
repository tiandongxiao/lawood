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

    # * ------------------用户层面的相关操作 ------------------ * #

    # 登录用户所有通告
    public function all()
    {
        $user = Auth::user();
        $notifies = $user->notifications;
        return view('notification.all',compact('notifies'));
    }

    # 登录用户所有已读通告
    public function read()
    {
        $user = Auth::user();
        $notifies = $user->notifications()->where('read',true)->get();
        return view('notification.read',compact('notifies'));
    }

    # 登录用户所有未读通告
    public function unread()
    {
        $user = Auth::user();
        $notifies = $user->notifications()->where('read',false)->get();
        return view('notification.unread',compact('notifies'));
    }
}
