<?php

namespace App\Http\Controllers\User;

use App\Cart;
use App\Item;
use App\Traits\ShopDevTrait;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Shop;
use App\Order;

class ClientController extends Controller
{
    use ShopDevTrait;

    private $user;

    public function __construct()
    {
        $this->middleware('auth',['except'=>'board']);
        $this->middleware('role:client',['except'=>'board']);
        $this->user = Auth::user();
    }

    public function notifies()
    {
        $notifies = $this->user->notifications;
        return view('client.notify.index',compact('notifies'));
    }

    # 总览面板
    public function board()
    {
        return view('client.board');
    }

    public function orders()
    {
        $orders = $this->user->orders;
        return view('client.order.index',compact('orders'));
    }

    # 返回未付款的订单列表
    public function pendingOrders()
    {
        $orders = $this->getPendingOrders($this->user);
        return view('client.order.pending',compact('orders'));
    }

    # 返回已经完成的订单列表
    public function completedOrders()
    {
        $orders = $this->getCompletedOrders($this->user);
        return view('client.order.completed',compact('orders'));
    }

    # 返回已支付订单列表
    public function payedOrders()
    {
        $orders = $this->getPayedOrders($this->user);
        return view('client.order.payed',compact('orders'));
    }

    # 用户反馈系统（评分，评论）
    public function feedback($id)
    {
        $order = Order::findOrFail($id);
        if($this->user->orders->contains($order) && $order->statusCode == 'completed')
            return view('client.order.feedback',compact('id'));
        return back()->withErrors('您无权对此订单进行评论');
    }

    public function postFeedback(Request $request)
    {        
        $order = Order::findOrFail($request->get('order_id'));
        if($this->user->orders->contains($order) && $order->statusCode == 'completed') {
            $seller = $order->seller;
            $seller->checkRatings();
            $consult = Item::findOrFail($order->items[0]->reference_id);

            $seller->rating([
                'rating' => $request->get('rating')
            ], $this->user);

            $seller->timing->rating([
                'rating' => $request->get('timing')
            ], $this->user);

            $seller->dressing->rating([
                'rating' => $request->get('dressing')
            ], $this->user);

            $seller->polite->rating([
                'rating' => $request->get('polite')
            ], $this->user);

            $consult->rating([
                'rating' => $request->get('major')
            ], $this->user);
            

            if ($request->get('comment')) {
                $seller->comment([
                    'title' => 'hello',
                    'body' => $request->get('comment')
                ], Auth::user());
            }

            return redirect('lawyer/show/'.$seller->id);
        }
        return back()->withErrors('您无权对此订单进行评论');
    }

    public function payPendingOrder($id)
    {
        $order = Order::findOrFail($id);
        if($this->user->orders->contains($order) && $order->statusCode == 'pending'){
            $consult_id = $order->items[0]->reference_id;
            $order->delete();
            return redirect('order/place/'.$consult_id);
        }
    }
}
