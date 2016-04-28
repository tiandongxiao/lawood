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
use Illuminate\Support\Facades\Log;
use EasyWeChat\Foundation\Application;
use EasyWeChat\Payment\Order;
use Illuminate\Support\Str;

class WxNativePay extends PaymentGateway
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
        Log::info(' -- WeChat NATIVE payment gateway is on processing');
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

            # 微信订单类
            $wx_order = new Order([
                'body'             => '服务费',             # 支付时显示给用户的内容项
                'detail'           => Str::random(16),     # 商品详情，
                'out_trade_no'     => uniqid('WX_ORDER_'), # 商户订单号
                'total_fee'        => $order->total,       # 分为基本单位
                'trade_type'       => 'NATIVE'             # 支付方式
            ]);

            $result = $this->payment->prepare($wx_order);

            if($result->return_code == 'SUCCESS' && $result->result_code == 'SUCCESS'){
                # 保存微信订单的信息
                $order->order_no = $wx_order->out_trade_no;
                $order->attach = $result->code_url;
                $order->save();

                $this->detail = '订单总金额为：'.($order->total/100).'元,尚未支付';
                $this->transactionId = $wx_order->out_trade_no; # 尚未生成交易信息,暂时使用微信单号
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