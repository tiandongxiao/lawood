<?php

namespace App\Http\Controllers\WeChat;

use App\Item;
use App\Self\WeChat\WeChatHelper;
use App\Traits\ShopDevTrait;
use App\Transaction;
use App\User;
use EasyWeChat\Foundation\Application;
use EasyWeChat\Payment\Order;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Shop;
use App\Cart;
use App\Order as ShopOrder;

class WxPayController extends Controller
{
    use ShopDevTrait;

    # 微信 app 实例
    private $app;

    # 微信支付句柄
    private $payment;

    # 用户服务句柄
    private $user;

    # 绑定相关微信服务
    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->payment = $this->app->payment;
        $this->user = $this->app->user;
    }

    # 微信支付回调函数（Native和JS-API使用同一个回调函数）
    public function callback()
    {
        $response = $this->payment->handleNotify(function($notify, $successful){
            # 返回值中不包含transaction_id时，此时用户尚未生成支付订单
            Log::info('This is notify transaction id --'.$notify->transaction_id.'||'.$successful);

            # 用户是否支付成功
            if ($successful) {

                Log::info('商户支付订单号 --'.$notify->out_trade_no);

                # 查询本地Shop Order对象
                $order = $this->queryShopOrder($notify->out_trade_no);
                $transaction = $order->transactions[0];

                # 订单状态设置为已支付
                $order->statusCode='payed';
                $order->save();

                # 将真正的transaction_id 赋予transaction对象
                $transaction->transaction_id = $notify->transaction_id;
                $transaction->save();

                $client = $this->client($order);
                $seller = $this->seller($order);

            } else {
                # 用户支付失败
                $order = $this->queryShopOrder($notify->out_trade_no);

                # 订单状态设置为支付失败
                $order->statusCode='failed';
                $order->save();
            }            

            return true; # 返回处理完成
        });

        return $response;
    }


    /**
     * Native 扫码支付方式（对应于微信第二种扫码支付方式）
     *
     * @param $product_id
     * @return 返回扫码支付界面
     */
    public function nativePay($item_id)
    {
        $order = $this->prePay($item_id, 'wx_native');

        if($order->statusCode == 'pending'){
            $url = $order->attach;
            $price = $order->total;
            return view('payment.wxpay.native',compact('url','price'));
        }

        return redirect('client/completed');
    }

    /**
     * JS-API 微信内浏览器支付方式
     *
     * @param $product_id
     * @return 返回用户在线支付商品信息显示界面
     */
    public function JSPay($item_id)
    {
        $wx_user = session('wechat.oauth_user');  # 拿到授权用户资料
        $open_id = $wx_user->getId();
        $helper = new WeChatHelper();
        $accessToken = $this->app->access_token; // EasyWeChat\Core\AccessToken 实例
        $token = $accessToken->getToken(); // token 字符串

        //$accessToken = Cache::get('wx_access_token');

        $info = $helper->getUnionID($open_id,$token);
        dd($info);

        if(!Auth::check()) {
            $wx_user = session('wechat.oauth_user');  # 拿到授权用户资料
            $open_id = $wx_user->getId();

            $user = User::where('wx_id', $open_id)->first();

            if (!$user) {
                $user = new User();
                $user->wx_id = $open_id;
                $user->save();
            }

            Log::info('我又登录了一次');

            Auth::login($user);
        }else{
            Log::info('我处于登录状态');
        }

        $order = $this->prePay($item_id, 'wx_js');

        if($order->statusCode == 'pending'){
            $params =  $order->attach;
            $price = $order->total;

            return view('payment.wxpay.jsapi',compact('params','price'));
        }

        return redirect('client/completed');
    }

    public function prePay($id, $gateway)
    {
        Cart::current()->clear();

        $this->addItemIntoCart($id);

        # 1 执行Shop的其他操作之前，必须先选择支付方式
        Shop::setGateway($gateway);

        # 2 准备结账
        if (!Shop::checkout()) {
            $exception = Shop::exception();
            echo $exception->getMessage();
        }

        # 3 下单
        $order = Shop::placeOrder();

        if ($order->hasFailed) {
            $exception = Shop::exception();
            echo $exception->getMessage();
        }

        return $order;
    }

    # 提现，目前没有实现，丫的要我充值
    public function withdraw($product_id)
    {
        $merchantPay = $this->app->merchant_pay;

        $user = session('wechat.oauth_user'); // 拿到授权用户资料
        $open_id = $user->getId();

        $merchantPayData = [
            'partner_trade_no' => str_random(16), # 随机字符串作为订单号，跟红包和支付一个概念。
            'openid' => $open_id, //收款人的openid
            'check_name' => 'NO_CHECK',  //文档中三分钟校验实名的方法NO_CHECK OPTION_CHECK FORCE_CHECK
            're_user_name'=>'王国营',     //OPTION_CHECK FORCE_CHECK 校验实名的时候必须提交
            'amount' => 100,  //单位为分
            'desc' => '企业付款',
            'spbill_create_ip' => '192.168.0.1',  //发起交易的IP地址
        ];

        $result = $merchantPay->send($merchantPayData);
        dd($result);
    }

    # 根据传入的微信订单号进行退款
    public function refundByOrderNo($out_trade_no)
    {
        if($this->isOrderRefunded($out_trade_no)){
            return back()->withErrors('订单不能重复退款');
        }

        $order = $this->queryOrder($out_trade_no);

        if($order){
            Log::info('退款流程：订单号'.$out_trade_no.' --- 退款金额：'.$order->total_fee);

            $refund_code = uniqid('REFUND');
            $result = $this->payment->refund($out_trade_no,$refund_code, $order->total_fee);

            if($result->return_code == 'SUCCESS' && $result->result_code == 'SUCCESS'){
                # 对Shop Order进行数据更新，改变订单状态
                $shop_order = ShopOrder::where('order_no',$out_trade_no)->first();
                $shop_order->statusCode = 'payed';
                $shop_order->save();
            }
        }
        return back()->withErrors('退款失败');
    }

    # 根据微信订单号查询订单
    public function queryOrder($out_trade_no)
    {
        $order = $this->payment->query($out_trade_no);
        if($order->return_code == 'SUCCESS' && $order->result_code == 'SUCCESS')
            return $order;
        return null;
    }


    # 判断微信订单是否已经退过款
    public function isOrderRefunded($out_trade_no)
    {
        $result = $this->payment->queryRefund($out_trade_no);
        if($result->return_code == 'SUCCESS' && $result->result_code == 'SUCCESS')
            return true;
        return false;
    }
}
