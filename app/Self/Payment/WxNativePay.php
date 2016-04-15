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
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Log;
use EasyWeChat\Foundation\Application;
use EasyWeChat\Payment\Order;

class WxNativePay extends PaymentGateway
{
    # 微信 app 实例
    private $app;

    # 微信支付句柄
    private $payment;

    # 用户服务句柄
    private $user;

    # 绑定相关微信服务
    public function initWxPay(Application $app)
    {
        $this->app = $app;
        $this->payment = $this->app->payment;
        $this->user = $this->app->user;
    }


    public function onCharge($order)
    {
        Log::info(' -- WeChat NATIVE payment gateway is on processing');


        //$this->initWxPay();

        $this->statusCode = 'pending';

        # 开始支付流程
        try {

            if ($order->total <= 0) {

                $this->statusCode = 'completed';

                $this->detail = 'Order total is 0; no PayPal transaction required.';

                $this->transactionId = uniqid();

                return true;
            }

            $wx_order = new Order([
                'body'             => '服务费',
                'detail'           => Str::random(16),
                'out_trade_no'     => Str::random(16),
                'total_fee'        => random_int(10,1000),
                'trade_type'       =>  'NATIVE'
            ]);


            $result = $this->payment->prepare($order);
            $price = $order->total_fee;
            $url = $result->code_url;


            return true;

        } catch (PayPalConnectionException $e) {

            $response = json_decode($e->getData());

            throw new GatewayException(
                sprintf(
                    '%s: %s',
                    $response->name,
                    isset($response->message) ? $response->message : 'Paypal payment Failed.'
                ),
                1001,
                $e
            );

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