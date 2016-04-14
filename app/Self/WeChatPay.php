<?php
/**
 * Created by PhpStorm.
 * User: tiandongxiao
 * Date: 14/04/2016
 * Time: 20:42
 */

namespace App\Self;

use Amsgames\LaravelShop\Core\PaymentGateway;
use Amsgames\LaravelShop\Exceptions\CheckoutException;
use Amsgames\LaravelShop\Exceptions\GatewayException;

class WeChatPay extends PaymentGateway
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

//        // Set the order to pending.
//        $this->statusCode = 'pending';
//
//
//        try {
//            if ($order->total <= 0) {
//                $this->detail = '订单费用为0，无需启动后续支付过程';
//                $this->transactionId = uniqid();
//                return true;
//            }
//
//
//            return true;
//        }  catch (\Exception $e) {
//            throw new ShopException(
//                $e->getMessage(),
//                1000,
//                $e
//            );
//        }
//        return false;
        return redirect('/');
    }

    /**
     * Called on callback.
     *
     * @param Order $order Order.
     * @param mixed $data  Request input from callback.
     *
     * @return bool
     */
    public function onCallbackSuccess($order, $data = null)
    {
        $this->statusCode     = 'completed';

        $this->detail         = 'successful callback';

        $this->transactionId  = $data->transactionId;

        // My code...
    }

    /**
     * Called on callback.
     *
     * @param Order $order Order.
     * @param mixed $data  Request input from callback.
     *
     * @return bool
     */
    public function onCallbackFail($order, $data = null)
    {
        $this->detail       = 'failed callback';

        // My code...
    }
}