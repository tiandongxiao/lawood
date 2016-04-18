<?php

namespace App\Http\Controllers\WeChat;

use App\Item;
use App\Traits\ShopDevTrait;
use App\Transaction;
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
            #返回值中不包含transaction_id时，此时用户尚未生成支付订单
            Log::info('This is notify transaction id --'.$notify->transaction_id.'||'.$successful);
            # 用户是否支付成功
            if ($successful) {
                # 不是已经支付状态则修改为已经支付状态
                # 使用通知里的 "微信支付订单号" 或者 "商户订单号" 去自己的数据库找到订单
                Log::info('商户支付订单号 --'.$notify->out_trade_no);
                $transaction = $this->globalSearchTransaction($notify->out_trade_no);
                $order =$transaction->order;
                Log::info($order->statusCode);
                $order->statusCode='completed';
                $order->save();
                Log::info($order->statusCode);

                # 将真正的transaction_id赋予transaction对象
                $transaction->transaction_id = $notify->transaction_id;
                Log::info('LLLLL'.$transaction->transaction_id);

                $client = $this->client($order);
                Log::info('客户邮件为--'.$client->email);

                $seller = $this->seller($order);
                Log::info('律师邮件为--'.$seller->email);



//                # 如果订单不存在
//                if (!$order) {
//                    return 'Order not exist.'; // 告诉微信，我已经处理完了，订单没找到，别再通知我了
//                }
//
//                # 检查订单是否已经更新过支付状态
//                if ($order->paid_at) { # 假设订单字段“支付时间”不为空代表已经支付
//                    return true; # 已经支付成功了就不再更新了
//                }
//                $order->paid_at = time(); # 更新支付时间为当前时间
//                $order->status = 'paid';

            } else {
                # 用户支付失败
                //$order->status = 'paid_fail';
            }

            //$order->save(); # 保存订单

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
    public function nativePay($id)
    {
        # 确保购物车中没有其他商品
        Cart::current()->clear();

        $this->addItemIntoCart($id);

        # 1 执行Shop的其他操作之前，必须先选择支付方式
        Shop::setGateway('wx_native');

        # 2 On checkout 准备结账
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

        $transaction = $order->transactions[0];

        $info = explode('||',$transaction->detail);

        $url = $info[0];
        $price = $info[1];
        return view('payment.wxpay.native',compact('url','price'));
    }

    /**
     * JS-API 微信内浏览器支付方式
     *
     * @param $product_id
     * @return 返回用户在线支付商品信息显示界面
     */
    public function JSPay($product_id)
    {
        $user = session('wechat.oauth_user'); // 拿到授权用户资料
        $open_id = $user->getId();

        $order = new Order([
            'body'            => '服务费',
            'detail'          => Str::random(16),
            'out_trade_no'    => Str::random(16),
            'total_fee'       => random_int(10,1000),
            'trade_type'      => 'JSAPI',
            'openid'          => $open_id
        ]);

        $result = $this->payment->prepare($order);
        $params = $this->payment->configForPayment($result->prepay_id);
        $price  = $order->total_fee;

        return view('payment.wxpay.jsapi',compact('params','price'));
    }

    public function refundByTransaction($id)
    {
        $order = $this->queryOrderByTransactionId($id);
        dd($order);

    }

    public function refundByOrderNo($orderNo)
    {
        $sum =
        $result = $this->payment->refund($orderNo, $refundNo, 100); // 总金额 100 退款 100，操作员：商户号
    }

    public function queryOrder($out_trade_no)
    {
        $order = $this->payment->query($out_trade_no);
        if($order)
            return $order;
        return null;
    }

    public function queryOrderByTransactionId($id)
    {
        $this->payment->queryByTransactionId($id);
    }
}
