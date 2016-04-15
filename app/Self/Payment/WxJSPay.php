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

class WxJSPay extends PaymentGateway
{
    /**
     * Called by shop to charge order's amount.
     *
     * @param Order $order Order.
     *
     * @return bool
     */
    public function onCharge($order)
    {
        Log::info(' -- WeChat JS-API payment gateway is on processing');
        dd('I am wx js');

        # Set the order to pending.
        $this->statusCode = 'pending';

        try {
            if ($order->total <= 0) {
                $this->detail = '订单费用为0，无需启动后续支付过程';
                $this->transactionId = uniqid();
                return true;
            }
            return true;
        }  catch (\Exception $e) {
            throw new ShopException(
                    $e->getMessage(),
                    1000,
                    $e
            );
        }
        return false;
    }
}