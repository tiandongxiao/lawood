<?php
/**
 * Created by PhpStorm.
 * User: tiandongxiao
 * Date: 14/04/2016
 * Time: 20:42
 */

namespace App\Self\Payment;

use Amsgames\LaravelShop\Core\PaymentGateway;
use Amsgames\LaravelShop\Exceptions\CheckoutException;
use Amsgames\LaravelShop\Exceptions\GatewayException;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Log;
use EasyWeChat\Payment\Order;
use Illuminate\Support\Str;
use App\Order as ShopOrder;

class WxJSPay extends PaymentGateway
{
    # 微信 app 实例
    private $app;

    # 微信支付句柄
    private $payment;

    # 用户服务句柄
    private $user;

    # 绑定相关微信服务
    public function initWxPay()
    {
        $this->app = app('wechat');
        $this->payment = $this->app->payment;
        $this->user = $this->app->user;
    }


    public function onCharge($order)
    {
        Log::info(' -- WeChat JS payment gateway is on processing');

        $this->initWxPay();
        $this->statusCode = 'pending'; # 将Shop订单状态设置为pending待付款

        # 开始支付流程
        try {
            # 如果订单的总金额为0，则其不需要走支付流程，直接将其状态设置为完成
            if ($order->total <= 0) {
                $this->statusCode = 'completed';
                $this->detail = 'Order total is 0; no PayPal transaction required.';
                $this->transactionId = uniqid('TRAN_');
                return true;
            }

            $user = Auth::user();
            $open_id = $user->open_id;
            Log::info('JS支付，openid--'.$open_id);
            Cache::add('order',$order,5);
            $wx_order = new Order([
                'openid'          => $open_id,
                'trade_type'      => 'JSAPI',
                'body'            => '法律服务费',
                'out_trade_no'    => time().rand(10000,99999),
                'total_fee'       => $order->total,
            ]);

            $result = $this->payment->prepare($wx_order);

            if($result->return_code == 'SUCCESS' && $result->result_code == 'SUCCESS'){

                # 获取JS支付相关参数
                $params = $this->payment->configForPayment($result->prepay_id);

                $order->update([
                    'order_no' => $wx_order->out_trade_no,
                    'attach'   => $params
                ]);

                $this->detail = '订单总金额为：'.($order->total/100).'元,尚未支付';

                # 尚未生成交易信息,暂时使用微信单号
                $this->transactionId = $wx_order->out_trade_no;
                return true;
            }
        } catch (\Exception $e) {
            throw new GatewayException(
                $e->getMessage(),
                1000,
                $e
            );
        }
        return false;
    }
}