<?php

namespace App\Http\Controllers\WeChat;

use EasyWeChat\Foundation\Application;
use EasyWeChat\Payment\Order;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class WxPayController extends Controller
{
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
            return true;

            # 使用通知里的 "微信支付订单号" 或者 "商户订单号" 去自己的数据库找到订单
             $order = null; #查询订单($notify->transaction_id);

            # 如果订单不存在
            if (!$order) {
                return 'Order not exist.'; // 告诉微信，我已经处理完了，订单没找到，别再通知我了
            }

            # 如果订单存在
            # 检查订单是否已经更新过支付状态
            if ($order->paid_at) { # 假设订单字段“支付时间”不为空代表已经支付
                return true; # 已经支付成功了就不再更新了
            }

            # 用户是否支付成功
            if ($successful) {
                # 不是已经支付状态则修改为已经支付状态
                $order->paid_at = time(); # 更新支付时间为当前时间
                $order->status = 'paid';
            } else {
                # 用户支付失败
                $order->status = 'paid_fail';
            }

            $order->save(); # 保存订单

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
        $order = new Order([
            'body'             => '服务费',
            'detail'           => Str::random(16),
            'out_trade_no'     => Str::random(16),
            'total_fee'        => random_int(10,1000),
            'trade_type'       =>  'NATIVE'
        ]);

        $result = $this->payment->prepare($order);
        $price = $order->total_fee;
        $url = $result->code_url;

        return view('payment.wxpay.native',compact('url','price'));
    }

    /**
     * JS-API 微信内浏览器支付方式
     *
     * @param $product_id
     * @return 返回用户在线支付商品信息显示界面
     */
    public function JSPay($item_id)
    {
        $user = session('wechat.oauth_user'); // 拿到授权用户资料
        $open_id = $user->getId();

        $order = new Order([
            'body'             => '服务费',
            'detail'           => Str::random(16),
            'out_trade_no'     => Str::random(16),
            'total_fee'        => random_int(10,1000),
            'trade_type'       =>  'JSAPI',
            'openid'          => $open_id
        ]);

        $result = $this->payment->prepare($order);
        $params = $this->payment->configForPayment($result->prepay_id);
        $price  = $order->total_fee;

        return view('payment.wxpay.jsapi',compact('params','price'));
    }
}
